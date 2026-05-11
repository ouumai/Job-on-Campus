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

    public function logout()
    {
        if (auth()->loggedIn()) {
            auth()->logout();
        }

        session()->remove(['user', 'otp_wrong', 'message', 'error', 'joctab_active']);

        return redirect()->to(base_url('login'))
            ->with('message', 'You have been signed out.');
    }

    public function showVerifyTokenPage()
    {
        if (! auth()->loggedIn()) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Sila log masuk terlebih dahulu.');
        }

        $language = session()->get('lang') ?? 'en';
        service('language')->setLocale($language);

        return view('auth/token_verify', [
            'user' => auth()->user(),
            'lang' => $language,
        ]);
    }

    /**
     * Proses Log Masuk
     */
    public function loginAction()
    {
        // Elak session user lama terbawa bila login akaun lain tanpa logout
        if (auth()->loggedIn()) {
            auth()->logout();
            session()->remove(['user', 'otp_wrong', 'message', 'error']);
        }

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

        // 1. SET BAHASA: ikut pilihan signup page dahulu, kemudian fallback session
        $postedLang = strtolower((string) $this->request->getPost('signup_lang'));
        $language = in_array($postedLang, ['en', 'ms'], true)
            ? $postedLang
            : (session()->get('lang') ?? 'en');
        session()->set('lang', $language);
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

        // 6. LOGIN USER KE SESSION
        /** @var \CodeIgniter\Shield\Authentication\Authenticators\Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        $authenticator->loginById($user->id);

        // 7-9. GENERATE, SIMPAN DAN HANTAR OTP
        $this->issueAndSendOtp($user, $language);

        // 10. REDIRECT KE VERIFY PAGE
        $msg = ($language === 'ms')
            ? 'Sila semak emel untuk kod pengesahan.'
            : 'Please check your email for verification code.';

        return redirect()
            ->to(base_url('verify-token'))
            ->with('message', $msg);
    }

    public function resendOtp()
    {
        if (! auth()->loggedIn()) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Sila log masuk terlebih dahulu.');
        }

        $language = session()->get('lang') ?? 'en';
        service('language')->setLocale($language);

        $users = model(UserModel::class);
        $user = $users->findById(auth()->id());

        if (! $user) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Pengguna tidak ditemui. Sila log masuk semula.');
        }

        $isSent = $this->issueAndSendOtp($user, $language);

        $msg = $language === 'ms'
            ? 'Kod OTP baharu telah dihantar ke emel anda.'
            : 'A new OTP code has been sent to your email.';

        $err = $language === 'ms'
            ? 'Gagal menghantar emel OTP. Sila cuba lagi.'
            : 'Failed to send OTP email. Please try again.';

        return redirect()->to(base_url('verify-token'))
            ->with($isSent ? 'message' : 'error', $isSent ? $msg : $err)
            ->with('otp_wrong', false);
    }

    public function verifyToken()
    {
        $token = trim((string) $this->request->getPost('token'));

        if ($token === '') {
            $otpFields = $this->request->getPost('otp_field');
            if (is_array($otpFields)) {
                $token = implode('', $otpFields);
            }
        }

        if (! preg_match('/^\d{6}$/', $token)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kod pengesahan mesti 6 digit.')
                ->with('otp_wrong', false);
        }

        $db = db_connect();

        $currentUserId = auth()->id();
        if (empty($currentUserId)) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Sesi tidak sah. Sila log masuk semula.');
        }

        $record = $db->table('auth_identities')
            ->where('user_id', $currentUserId)
            ->where('type', 'email_otp')
            ->where('secret', $token)
            ->orderBy('id', 'DESC')
            ->get()
            ->getRow();

        if (!$record) {
            return redirect()->back()
                ->with('error', 'Kod pengesahan tidak sah.')
                ->with('otp_wrong', true);
        }

        // Check expired
        if (strtotime($record->expires) < time()) {
            return redirect()->back()
                ->with('error', 'Kod telah tamat tempoh.')
                ->with('otp_wrong', false);
        }

        // Activate user
        $users = model(UserModel::class);

        $users->update($record->user_id, [
            'active' => 1
        ]);

        // Delete OTP after success
        $db->table('auth_identities')
            ->where('id', $record->id)
            ->delete();

        return redirect()
            ->to(base_url('login'))
            ->with('message', 'Akaun berjaya disahkan.');
    }

    private function issueAndSendOtp($user, string $language): bool
    {
        $otp = (string) random_int(100000, 999999);
        $db = db_connect();

        $db->table('auth_identities')
            ->where('user_id', $user->id)
            ->where('type', 'email_otp')
            ->delete();

        $db->table('auth_identities')->insert([
            'user_id' => $user->id,
            'type'    => 'email_otp',
            'secret'  => $otp,
            'secret2' => null,
            'expires' => date('Y-m-d H:i:s', strtotime('+10 minutes')),
        ]);

        $otpRecord = $db->table('auth_identities')
            ->where('user_id', $user->id)
            ->where('type', 'email_otp')
            ->orderBy('id', 'DESC')
            ->get()
            ->getRow();
        $otpFromDb = (string) ($otpRecord->secret ?? '');

        $email = service('email');
        $email->setTo($user->email);
        $email->setSubject(
            $language === 'ms'
                ? 'Kod Pengesahan Akaun'
                : 'Account Verification Code'
        );
        $email->setMessage(
            view('email/activation_email', [
                'token' => $otpFromDb,
                'user'  => $user,
            ])
        );

        return (bool) $email->send();
    }
}
