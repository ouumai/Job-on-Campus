<?php

namespace App\Controllers;

use App\Services\LocationService;
use App\Models\UserModel; 
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegister;

class AuthController extends BaseController
{
    protected $locationService;

    public function __construct()
    {
        $this->locationService = new LocationService();
    }

    public function index()
    {
        $data = [
            'metronic' => $this->locationService->getMetronic(),
            'asset'    => $this->locationService->getAssets(),
        ];
        return view('auth/login', $data);
    }

    public function signup()
    {
        $data = [
            'metronic' => $this->locationService->getMetronic(),
            'asset'    => $this->locationService->getAssets(),
        ];
        return view('auth/signup', $data);
    }

    /**
     * Proses Log Masuk
     */
    public function loginAction()
    {
        // 1. Validasi Input
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Sila masukkan emel dan kata laluan yang sah.');
        }

        // 2. Ambil Kredential
        $credentials = [
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];
        
        $remember = (bool) $this->request->getPost('remember');

        // 3. Proses Log Masuk (Syntax Shield Stabil)
        /** @var \CodeIgniter\Shield\Authentication\Authenticators\Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Shield attempt() secara automatik mengendalikan 'remember me' jika berjaya
        $result = $authenticator->attempt($credentials);
        
        if (! $result->isOK()) {
            return redirect()->route('login')->withInput()->with('error', $result->reason());
        }

        // 4. Check jika ada Action (seperti OTP/Email Verification)
        $user = $result->extraInfo();
        
        // Jika user berjaya login, kita semak action melalui user object
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show')->withCookies();
        }

        // 5. Jika 'remember' ditanda, set secara manual jika perlu
        if ($remember) {
            $authenticator->remember();
        }

        // 6. Selesai, redirect ke dashboard
        return redirect()->to(config('Auth')->loginRedirect())->withCookies();
    }

    /**
     * Proses Pendaftaran (Full Fixed Code)
     */
    public function registerAction()
    {
        $users = model(UserModel::class);

        // 1. SET BAHASA: Ambil dari session yang diset oleh Language Controller kau
        $language = session()->get('lang') ?? 'en';
        service('language')->setLocale($language);

        // 2. VALIDATION RULES
        $rules = [
            'first_name'    => 'required|min_length[1]',
            'last_name'     => 'required|min_length[1]',
            'user_category' => 'required|in_list[pelajar,kakitangan]',
            'identity_no'   => 'required|is_unique[users.identity_no]',
            'email'         => 'required|valid_email|is_unique[auth_identities.secret]|max_length[255]',
            'password'      => 'required|strong_password',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. CIPTA ENTITI USER
        $identity = $this->request->getPost('identity_no');
        $user = new User([
            'username'      => $identity,
            'email'         => $this->request->getPost('email'),
            'password'      => $this->request->getPost('password'),
            'first_name'    => $this->request->getPost('first_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'identity_no'   => $identity,
            'user_category' => $this->request->getPost('user_category'),
        ]);

        // 4. SIMPAN KE DATABASE
        $users->save($user);
        $user = $users->findById($users->getInsertID());

        // 5. TAMBAH GROUP
        $category = $this->request->getPost('user_category');
        $user->addGroup($category === 'pelajar' ? 'student' : 'supervisor');

        // 6. TRIGGER AUTH ACTION (FIXED)
        /** @var \CodeIgniter\Shield\Authentication\Authenticators\Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Gunakan loginById untuk 'pacak' session tanpa aktifkan user lagi
        $authenticator->loginById($user->id);
        
        // Jalankan action 'register' (hantar emel aktivasi)
        $hasAction = $authenticator->startUpAction('register', $user);
        
        if ($hasAction) {
            $msg = ($language === 'ms') ? 'Sila semak emel untuk kod pengesahan.' : 'Please check your email for verification code.';
            return redirect()->route('auth-action-show')->with('message', $msg);
        }

        return redirect()->to(base_url('login'))->with('message', 'Pendaftaran berjaya!');
    }
}