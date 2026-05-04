<?php

namespace App\Controllers;

use App\Services\LocationService; // Call LocationService untuk dapatkan path ke assets dan Metronic

class AuthController extends BaseController
{
    protected $locationService;

    public function __construct()
    {
        $this->locationService = new LocationService(); // Inisialisasi
    }

    public function login()
    {
        // Data untuk dihantar ke view
        $data = [
            'title'   => 'Login | JoC System',
            'asset'   => $this->locationService->getAssets(),   // Path ke /public/assets/
            'metronic' => $this->locationService->getMetronic(), // Path ke Metronic Demo 2
        ];

        return view('auth/login', $data); 
    }
}