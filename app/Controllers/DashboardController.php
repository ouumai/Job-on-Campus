<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        // 1. Jika user adalah Pelajar (Student)
        if ($user->inGroup('student')) {
            return redirect()->to(site_url('semakan'));
        }

        // 2. Jika user adalah Penyelia (Supervisor)
        if ($user->inGroup('supervisor')) {
            return redirect()->to(site_url('penyelia/semakan'));
        }

        // 3. Jika user adalah Urusetia (Career)
        if ($user->inGroup('career')) {
            return redirect()->to(site_url('pengguna/dashboard'));
        }

        // Laluan keselamatan sekiranya peranan tidak sah
        return redirect()->to(site_url('logout'))->with('error', 'Peranan pengguna tidak sah.');
    }
}