<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Authentication\Authenticators\Session as SessionAuthenticator;
use CodeIgniter\Shield\Models\RememberModel;
use CodeIgniter\Shield\Models\UserIdentityModel;
use App\Models\UserModel;

class MagicLinkController extends \CodeIgniter\Shield\Controllers\MagicLinkController
{
    private function applyLocaleFromSession(): void
    {
        $lang = session()->get('lang') ?? 'ms';
        if (! in_array($lang, ['en', 'ms'], true)) {
            $lang = 'ms';
        }
        service('language')->setLocale($lang);
    }

    public function loginView()
    {
        $this->applyLocaleFromSession();

        return parent::loginView();
    }

    public function loginAction()
    {
        $postedLang = strtolower((string) $this->request->getPost('fp_lang'));
        if (in_array($postedLang, ['en', 'ms'], true)) {
            session()->set('lang', $postedLang);
        }

        $this->applyLocaleFromSession();
        if (! setting('Auth.allowMagicLinkLogins')) {
            return redirect()->route('login')->with('error', lang('Auth.magicLinkDisabled'));
        }

        $rules = $this->getValidationRules();
        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->route('magic-link')->with('errors', $this->validator->getErrors());
        }

        $emailAddress = (string) $this->request->getPost('email');
        $user = $this->provider->findByCredentials(['email' => $emailAddress]);

        if ($user === null) {
            return redirect()->route('magic-link')->with('error', lang('Auth.invalidEmail', [$emailAddress]));
        }

        $userId = $user->id ?? null;
        if ($userId === null) {
            return redirect()->route('magic-link')->with('error', 'Pengguna tidak lengkap. Sila cuba lagi.');
        }

        $userModel = model(UserModel::class);
        $user = $userModel->findById($userId);
        if ($user === null) {
            return redirect()->route('magic-link')->with('error', 'Pengguna tidak ditemui.');
        }

        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);
        $identityModel->where('user_id', $userId)
            ->where('type', SessionAuthenticator::ID_TYPE_MAGIC_LINK)
            ->delete();

        helper('text');
        $token = random_string('crypto', 20);

        $identityModel->insert([
            'user_id' => $userId,
            'type'    => SessionAuthenticator::ID_TYPE_MAGIC_LINK,
            'secret'  => $token,
            'expires' => Time::now()->addSeconds(setting('Auth.magicLinkLifetime')),
        ]);

        $language = session()->get('lang') ?? 'en';
        $subject = $language === 'ms'
            ? 'Pautan Tetapan Semula Kata Laluan'
            : 'Password Reset Link';

        helper('email');
        $email = emailer(['mailType' => 'html'])
            ->setFrom(setting('Email.fromEmail'), setting('Email.fromName') ?? '');
        $email->setTo($user->email);
        $email->setSubject($subject);
        $email->setMessage($this->view(
            setting('Auth.views')['magic-link-email'],
            ['token' => $token, 'user' => $user, 'ipAddress' => $this->request->getIPAddress(), 'userAgent' => (string) $this->request->getUserAgent(), 'date' => Time::now()->toDateTimeString()],
            ['debug' => false],
        ));

        if ($email->send(false) === false) {
            log_message('error', $email->printDebugger(['headers']));
            return redirect()->route('magic-link')->with('error', lang('Auth.unableSendEmailToUser', [$user->email]));
        }

        $email->clear();

        return $this->displayMessage();
    }

    public function verify(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->applyLocaleFromSession();

        if ($this->request->getUserAgent()->isRobot()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $token = (string) $this->request->getGet('token');

        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);
        $identity = $identityModel->getIdentityBySecret(SessionAuthenticator::ID_TYPE_MAGIC_LINK, $token);

        if ($identity === null) {
            return redirect()->route('magic-link')->with('error', lang('Auth.magicTokenNotFound'));
        }

        $identityModel->delete($identity->id);

        if (Time::now()->isAfter($identity->expires)) {
            return redirect()->route('magic-link')->with('error', lang('Auth.magicLinkExpired'));
        }

        // Simpan user sementara untuk flow reset password (5 minit)
        session()->setTempdata('password_reset_user_id', $identity->user_id, 300);

        return redirect()->to(base_url('reset-password'));
    }

    public function resetPasswordView()
    {
        $this->applyLocaleFromSession();

        $resetUserId = session()->getTempdata('password_reset_user_id');
        if (empty($resetUserId)) {
            return redirect()->to(base_url('forgot-password'))
                ->with('error', 'Sesi tetapan semula kata laluan tidak sah atau telah tamat.');
        }

        $userModel = model(UserModel::class);
        $user = $userModel->findById((int) $resetUserId);
        if ($user === null) {
            return redirect()->to(base_url('forgot-password'))
                ->with('error', 'Pengguna tidak ditemui.');
        }

        return view('auth/reset_password', ['user' => $user]);
    }

    public function resetPasswordAction()
    {
        $this->applyLocaleFromSession();

        $resetUserId = session()->getTempdata('password_reset_user_id');
        if (empty($resetUserId)) {
            return redirect()->to(base_url('forgot-password'))
                ->with('error', 'Sesi tetapan semula kata laluan tidak sah atau telah tamat.');
        }

        $rules = [
            'user_id' => 'required|integer',
            'password' => 'required',
            'confirm_password' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $postedUserId = (int) $this->request->getPost('user_id');
        if ($postedUserId !== (int) $resetUserId) {
            return redirect()->to(base_url('forgot-password'))
                ->with('error', 'Pengguna tidak sah untuk sesi ini.');
        }

        $userModel = model(UserModel::class);
        $user = $userModel->findById($postedUserId);
        if ($user === null) {
            return redirect()->to(base_url('forgot-password'))
                ->with('error', 'Pengguna tidak ditemui.');
        }

        $newPassword = (string) $this->request->getPost('password');
        
        // Manual password strength check to prevent LogicException with incomplete User object
        $checker = service('passwords');
        $result = $checker->check($newPassword, $user);
        if (! $result->isOK()) {
            return redirect()->back()->withInput()->with('errors', ['password' => $result->reason()]);
        }
        $user->fill(['password' => $newPassword]);
        $userModel->save($user);

        /** @var RememberModel $rememberModel */
        $rememberModel = model(RememberModel::class);
        $rememberModel->where('user_id', $user->id)->delete();

        session()->removeTempdata('password_reset_user_id');
        auth()->logout();

        return redirect()->to(base_url('login'))
            ->with('message', 'Kata laluan baharu berjaya disimpan. Sila log masuk.');
    }
}
