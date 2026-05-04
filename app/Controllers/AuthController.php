<?php

namespace App\Controllers;

use App\Services\LocationService;

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

        return view('auth/login', $data); // Pastikan fail kau nama login.php dalam folder Views/auth/
    }
}