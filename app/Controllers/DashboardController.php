<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Terus panggil fail view dashboard utama selepas log masuk
        return view('dashboard'); 
    }
}