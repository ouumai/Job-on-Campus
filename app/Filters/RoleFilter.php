<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check kalau user dah login
        if (! auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        // Kalau tak ada argument (cth: role:student), bagi lepas je
        if (empty($arguments)) {
            return;
        }

        // Check group user dalam Shield 
        foreach ($arguments as $group) {
            if (auth()->user()->inGroup($group)) {
                return;
            }
        }

        // Kalau tak ada role yang betul, pergi ke dashboard 
        return redirect()->to('/dashboard')->with('error', 'Akses tidak dibenarkan.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}