<?php

namespace App\Controllers;

use App\Services\LocationService;
use App\Models\UserModel; // Guna custom model kita tadi
use CodeIgniter\Shield\Entities\User;

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

    // FUNGSI BARU: Proses Pendaftaran
    public function registerAction()
    {
        $users = model(UserModel::class);

        // 1. Set Validation Rules
        $rules = [
            'first_name'    => 'required|min_length[1]',
            'last_name'     => 'required|min_length[1]',
            'user_category' => 'required|in_list[pelajar,kakitangan]',
            'identity_no'   => [
                'rules' => 'required|is_unique[users.identity_no]|' . ($this->request->getPost('user_category') == 'pelajar' 
                    ? 'regex_match[/^[AP][0-9]+$/]' 
                    : 'regex_match[/^K(S|Q)?[0-9]+$/]'),
            ],
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|strong_password',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Tangkap data & Set Identity No sebagai Username
        $identity = $this->request->getPost('identity_no');
        
        $user = new User([
            'username'      => $identity, // Automatik guna ID
            'email'         => $this->request->getPost('email'),
            'password'      => $this->request->getPost('password'),
            'first_name'    => $this->request->getPost('first_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'identity_no'   => $identity,
            'user_category' => $this->request->getPost('user_category'),
        ]);

        // 3. Simpan ke Database
        $users->save($user);

        // 2. Ambil balik ID user yang baru masuk
        $userId = $users->getInsertID();
        $user = $users->findById($userId);

        // 3. Tambah Group (Guna key yang betul: 'student' atau 'supervisor')
        $category = $this->request->getPost('user_category');
        if ($category === 'pelajar') {
            $user->addGroup('student');
        } else {
            $user->addGroup('supervisor');
        }

        // 4. Trigger Shield Registration Action and redirect
        // Lepas addGroup
        
        /** @var \CodeIgniter\Shield\Authentication\Authenticators\Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();
        $authenticator->startLogin($user);
        
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show')->with('message', 'Sila semak emel untuk kod pengesahan pendaftaran.');
        }

        $user->activate();
        return redirect()->to(base_url('login'))->with('message', 'Pendaftaran berjaya!');
    }
}