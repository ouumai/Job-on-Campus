<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('lang', 'Language::index');

# -- AUTHENTICATION --
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::loginAction');
$routes->get('logout', 'AuthController::logout');

$routes->get('signup', 'AuthController::signup');
$routes->post('signup', 'AuthController::registerAction');
$routes->get('forgot-password', 'MagicLinkController::forgotPasswordView', ['as' => 'magic-link']);
$routes->post('forgot-password', 'MagicLinkController::loginAction');
$routes->get('magic-link', 'MagicLinkController::verify', ['as' => 'magic-link-verify']);
$routes->get('reset-password', 'MagicLinkController::resetPasswordView');
$routes->post('reset-password', 'MagicLinkController::resetPasswordAction');
$routes->get('verify-token', 'AuthController::showVerifyTokenPage');
$routes->post('verify-token', 'AuthController::verifyToken');
$routes->post('resend-otp', 'AuthController::resendOtp');

# -- SHIELD ACTION ROUTES (Email Activation, etc) --
$routes->get('auth/a/show', '\CodeIgniter\Shield\Controllers\ActionController::show', ['as' => 'auth-action-show']);
$routes->post('auth/a/handle', '\CodeIgniter\Shield\Controllers\ActionController::handle', ['as' => 'auth-action-handle']);
$routes->post('auth/a/verify', '\CodeIgniter\Shield\Controllers\ActionController::verify', ['as' => 'auth-action-verify']);


# ============================================================================
# -- TRAFFIC CONTROLLER & ROLE-BASED ROUTES (JOC SYSTEM v1.6) --
# ============================================================================

// Penghalaan Utama Selepas Log Masuk Berjaya
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// 1. KUMPULAN PERANAN: PELAJAR (STUDENT)
$routes->group('pelajar', ['filter' => 'group:student'], static function ($routes) {
    $routes->get('iklan_senarai', 'Pelajar::iklan_senarai');          // iklan_senarai.php 
    $routes->get('permohonan_senarai', 'Pelajar::permohonan_senarai'); // permohonan_senarai.php 
    $routes->get('surat_senarai', 'Pelajar::surat_senarai');      // surat_senarai.php 
    $routes->get('timesheet_form', 'Pelajar::timesheet_form');    // timesheet_form.php 
    $routes->get('claim_form', 'Pelajar::claim_form');            // claim_form.php 
});

// Semakan dashboard utama pelajar (Pautan URL: /semakan)
$routes->get('semakan', 'Pelajar::semakan', ['filter' => 'group:student']); // semakan.php 


// 2. KUMPULAN PERANAN: PENYELIA (SUPERVISOR)
$routes->group('penyelia', ['filter' => 'group:supervisor'], static function ($routes) {
    $routes->get('iklan/senarai', 'Penyelia::iklan_senarai');     // iklan/senarai.php 
    $routes->get('iklan/form', 'Penyelia::iklan_form');           // iklan/form.php 
    $routes->get('calon/senarai', 'Penyelia::calon_senarai');     // calon/senarai.php 
    $routes->get('calon/import', 'Penyelia::calon_import');       // calon/import.php 
    $routes->get('bajet_ptj', 'Penyelia::bajet_ptj');             // bajet_ptj.php 
    $routes->get('ketua_projek', 'Penyelia::ketua_projek');       // ketua_projek.php 
    $routes->get('semakan', 'Penyelia::semakan');                 // semakan.php
    $routes->get('laporan_ptj', 'Penyelia::laporan_ptj');         // laporan_ptj.php
});


// 3. KUMPULAN PERANAN: URUSETIA (CAREER)
$routes->group('urusetia', ['filter' => 'group:career'], static function ($routes) {
    $routes->get('iklan/senarai', 'Urusetia::iklan_senarai');     // iklan/senarai.php
    $routes->get('iklan/form', 'Urusetia::iklan_form');           // iklan/form.php
    $routes->get('iklan/calon_senarai', 'Urusetia::calon_senarai'); // iklan/calon_senarai.php
});

// Laluan khusus Urusetia mengikut folder struktur view
$routes->get('pengguna/dashboard', 'Urusetia::dashboard', ['filter' => 'group:career']); // pengguna/dashboard.php 
$routes->get('pengguna/bajet', 'Urusetia::bajet', ['filter' => 'group:career']);         // pengguna/bajet.php 
$routes->get('kelulusan/senarai', 'Urusetia::kelulusan_senarai', ['filter' => 'group:career']); // kelulusan/senarai.php
