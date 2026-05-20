<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UrusetiaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class DashboardController extends BaseController
{
    public function index()
    {
        // Terus panggil fail view dashboard utama selepas log masuk
        return view('dashboard'); 
    }

    public function profil()
    {
        $user = auth()->user();

        $ukmper = trim((string) ($user->identity_no ?? $user->username ?? ''));
        $urusetiaModel = model(UrusetiaModel::class);
        $urusetiaInfo = $ukmper !== '' ? $urusetiaModel->getByUkmper($ukmper) : null;
        $isUrusetia = $urusetiaInfo !== null && (int) ($urusetiaInfo->aktif ?? 0) === 1;

        return view('profile', [
            'user' => $user,
            'isUrusetia' => $isUrusetia,
            'urusetiaInfo' => $urusetiaInfo,
        ]);
    }

    public function updateProfil(): RedirectResponse
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to(site_url('login'))->with('error', 'Sila log masuk semula.');
        }

        $rules = [
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name'  => 'required|min_length[2]|max_length[100]',
            'email'      => 'required|valid_email|max_length[255]',
            'current_password' => 'permit_empty|min_length[8]',
            'new_password' => 'permit_empty|strong_password',
            'confirm_password' => 'permit_empty|matches[new_password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();
        $newEmail = strtolower(trim((string) $this->request->getPost('email')));

        $emailExists = $db->table('auth_identities')
            ->where('type', 'email_password')
            ->where('secret', $newEmail)
            ->where('user_id !=', (int) $user->id)
            ->countAllResults();

        if ($emailExists > 0) {
            return redirect()->back()->withInput()->with('error', 'Emel tersebut telah digunakan oleh pengguna lain.');
        }

        $updateData = [
            'first_name' => trim((string) $this->request->getPost('first_name')),
            'last_name'  => trim((string) $this->request->getPost('last_name')),
        ];
        $existingProfileImage = trim((string) ($user->profile_image ?? ''));
        $removeProfileImage = $this->request->getPost('remove_profile_image') === '1';

        $avatar = $this->request->getFile('profile_image');
        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $this->validate([
                'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|max_size[profile_image,2048]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]',
            ])) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profile';
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            $newName = $avatar->getRandomName();
            $avatar->move($uploadPath, $newName);
            $updateData['profile_image'] = 'uploads/profile/' . $newName;

            if ($existingProfileImage !== '') {
                $oldFile = FCPATH . ltrim($existingProfileImage, '/\\');
                if (is_file($oldFile)) {
                    @unlink($oldFile);
                }
            }
        } elseif ($removeProfileImage && $existingProfileImage !== '') {
            $oldFile = FCPATH . ltrim($existingProfileImage, '/\\');
            if (is_file($oldFile)) {
                @unlink($oldFile);
            }
            $updateData['profile_image'] = null;
        }

        $currentPassword = (string) $this->request->getPost('current_password');
        $newPassword = (string) $this->request->getPost('new_password');

        if ($newPassword !== '') {
            if ($currentPassword === '') {
                return redirect()->back()->withInput()->with('error', 'Sila masukkan kata laluan semasa untuk tukar kata laluan baharu.');
            }

            $identity = $db->table('auth_identities')
                ->where('user_id', (int) $user->id)
                ->where('type', 'email_password')
                ->get()
                ->getRow();

            if (! $identity) {
                return redirect()->back()->withInput()->with('error', 'Maklumat akaun tidak lengkap. Sila hubungi pentadbir.');
            }

            $passwordHash = $identity->secret2 ?? '';
            if (! password_verify($currentPassword, $passwordHash)) {
                return redirect()->back()->withInput()->with('error', 'Kata laluan semasa tidak tepat.');
            }

            $db->table('auth_identities')
                ->where('user_id', (int) $user->id)
                ->where('type', 'email_password')
                ->update([
                    'secret2' => password_hash($newPassword, PASSWORD_DEFAULT),
                ]);
        }

        $db->table('auth_identities')
            ->where('user_id', (int) $user->id)
            ->where('type', 'email_password')
            ->update([
                'secret' => $newEmail,
            ]);

        $users = model(UserModel::class);
        $users->update((int) $user->id, $updateData);

        return redirect()->to(site_url('profil'))->with('message', 'Profil berjaya dikemaskini.');
    }
}
