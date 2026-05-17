<!DOCTYPE html>
<html lang="<?= session('lang') ?? 'ms' ?>">
<head>
    <meta charset="utf-8" />
    <title>Selamat Datang | Job on Campus (JoC)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    
    <style>
        body {
            background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
            background-attachment: fixed !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Glassmorphism Navigation Bar */
        .welcome-navbar {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.03);
        }

        /* Glassmorphism Content Card */
        .welcome-card {
            background: rgba(255, 255, 255, 0.45) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0,0,0,0.06) !important;
            border-radius: 1.5rem !important;
            max-width: 780px;
            width: 100%;
        }

        .joc-logo-text {
            font-size: 3.8rem;
            background: linear-gradient(to right, #0052D4, #4364F7, #6FB1FC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>

<nav class="navbar welcome-navbar py-4">
    <div class="container-xxl d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <i class="ki-duotone ki-teacher fs-1 text-primary">
                <span class="path1"></span><span class="path2"></span>
            </i>
            <span class="fs-4 fw-bolder text-gray-900 tracking-tight">Job on Campus (JoC)</span>
        </div>
        
        <div class="d-flex align-items-center gap-4">
            
            <div class="me-2">
                <?php 
                    $currentLang = session('lang') ?? 'ms';
                    $flag = ($currentLang == 'en') ? 'united-states.svg' : 'malaysia.svg';
                ?>
                <button class="btn btn-icon btn-active-light-primary w-35px h-35px rounded-circle" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <img class="h-20px w-20px rounded-sm" src="<?= base_url('assets/media/flags/' . $flag) ?>" alt="lang" />
                </button>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-175px" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="<?= site_url('lang/en') ?>" class="menu-link d-flex px-5 <?= ($currentLang == 'en') ? 'active' : '' ?>">
                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/united-states.svg') ?>" /></span>English
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="<?= site_url('lang/ms') ?>" class="menu-link d-flex px-5 <?= ($currentLang == 'ms') ? 'active' : '' ?>">
                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/malaysia.svg') ?>" /></span>Bahasa Melayu
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <a href="<?= site_url('login') ?>" class="btn btn-primary fw-bold px-6 py-2.5 fs-6 shadow-sm text-hover-white">
                    Log Masuk <i class="ki-duotone ki-entrance-right fs-4 ms-1"><span class="path1"></span><span class="path2"></span></i>
                </a>
            </div>
        </div>
    </div>
</nav>
<div class="container d-flex flex-grow-1 align-items-center justify-content-center p-5 my-10">
    <div class="card welcome-card p-8 p-lg-15 text-center animate__animated animate__fadeIn">
        <div class="card-body">
            <div class="mb-5">
                <span class="badge badge-light-primary fw-bold px-4 py-2.5 fs-7 text-uppercase tracking-wider">
                    Portal Rasmi DigitalUKM
                </span>
            </div>

            <h1 class="fw-bolder mb-3 joc-logo-text">Job on Campus</h1>
            <h3 class="text-gray-800 fw-bold mb-8 fs-2">Sistem Pengurusan Kerjaya Kampus</h3>

            <p class="text-gray-700 fs-5 fw-medium leading-xl mb-0 mx-auto" style="max-width: 650px;">
                Selamat datang ke platform digital **Pusat Teknologi Digital (DigitalUKM)**. 
                Sistem JoC menghubungkan pelajar secara terus dengan peluang pekerjaan aktif di dalam kampus, 
                memudahkan proses permohonan, log log kerja (*timesheet*), serta pengurusan tuntutan bayaran secara sistematik.
            </p>

            <div class="separator separator-dashed border-gray-300 w-100 mt-10 mb-8"></div>

            <div class="text-gray-600 fs-7 fw-semibold">
                &copy; 2026 Pusat Teknologi Digital (DigitalUKM). All rights reserved.
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
<script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
</body>
</html>