<!DOCTYPE html>
<html lang="<?= session('lang') ?? 'ms' ?>">
<head>
    <?php $currentLang = session('lang') ?? 'ms'; ?>
    <meta charset="utf-8" />
    <title><?= $currentLang === 'ms' ? 'Selamat Datang' : 'Welcome' ?> | Job on Campus (JoC)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/JoCLogo.png') ?>" />
    
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
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
            z-index: 1000 !important;
        }

        .language-toggle {
            transition: background-color .2s ease-in-out;
            min-width: 90px;
        }

        .language-toggle .lang-label {
            margin-left: 0.35rem;
            font-weight: 500;
            color: #444;
        }

        /* Glassmorphism Content Card */
        .welcome-card {
            background: rgba(255, 255, 255, 0.45) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0,0,0,0.06) !important;
            border-radius: 1.5rem !important;
            max-width: 1100px;
            width: 100%;
        }

        .joc-logo-text {
            font-size: 4.8rem;
            background: linear-gradient(to right, #0052D4, #4364F7, #6FB1FC);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>

<?php 
    $currentLang = session('lang') ?? 'ms';
    $flag = ($currentLang == 'en') ? 'united-kingdom.svg' : 'malaysia.svg';
    $langName = ($currentLang == 'en') ? 'English' : 'Bahasa Melayu';
?>

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
                <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base px-0 language-toggle" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-offset="0px,0px">
                    <img class="w-20px h-20px rounded me-3" src="<?= base_url('assets/media/flags/' . $flag) ?>" alt="lang" />
                    <span class="me-1 d-none d-md-inline"><?= esc($langName) ?></span>
                    <span class="svg-icon svg-icon-5 text-muted rotate-180 m-0" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 fs-7 w-200px" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="<?= site_url('lang?lang=en') ?>" class="menu-link d-flex px-5 <?= ($currentLang == 'en') ? 'active' : '' ?>" data-kt-lang="en">
                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/united-kingdom.svg') ?>" alt="English" /></span>
                            <span>English</span>
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="<?= site_url('lang?lang=ms') ?>" class="menu-link d-flex px-5 <?= ($currentLang == 'ms') ? 'active' : '' ?>" data-kt-lang="ms">
                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/malaysia.svg') ?>" alt="Bahasa Melayu" /></span>
                            <span>Bahasa Melayu</span>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <a href="<?= site_url('login') ?>" class="btn btn-primary fw-bold px-6 py-2.5 fs-6 shadow-sm text-hover-white">
                    <?= $currentLang === 'en' ? 'Login' : 'Log Masuk' ?> <i class="ki-duotone ki-entrance-right fs-4 ms-1"><span class="path1"></span><span class="path2"></span></i>
                </a>
            </div>
        </div>
    </div>
</nav>
<div class="container d-flex flex-grow-1 align-items-center justify-content-center p-5 my-10">
    <div class="card welcome-card p-8 p-lg-15 text-center animate__animated animate__fadeIn">
        <div class="card-body">
            <h1 class="fw-bolder mb-3 joc-logo-text">Job on Campus</h1>
            <h3 class="text-gray-800 fw-bold mb-8 fs-2">
                <?= $currentLang === 'en' ? 'Campus Career Management System' : 'Sistem Pengurusan Kerjaya Kampus' ?>
            </h3>

            <div class="text-gray-700 fs-4 fw-medium leading-xl mx-auto mb-8" style="max-width: 900px; text-align: justify;">
                <?php if ($currentLang === 'en'): ?>
                    Welcome to the digital platform of the <b>Pusat Teknologi Digital (DigitalUKM)</b>. 
                    The Job on Campus (JoC) system is specially designed as an integrated career hub to manage short-term employment opportunities on campus through three main functions:
                <?php else: ?>
                    Selamat datang ke platform digital <b>Pusat Teknologi Digital (DigitalUKM)</b>. 
                    Sistem Job on Campus (JoC) direka khas sebagai hab kerjaya bersepadu bagi menguruskan peluang pekerjaan jangka pendek dalam kampus melalui tiga fungsi utama:
                <?php endif; ?>
            </div>

            <div class="row g-8 text-start justify-content-center my-8 mx-auto" style="max-width: 1000px;">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-compass fs-2x text-primary me-3"><span class="path1"></span><span class="path2"></span></i>
                        <h4 class="text-gray-900 fw-bolder mb-0 d-flex align-items-center">
                            <?= $currentLang === 'en' ? 'Student Exploration' : 'Eksplorasi Pelajar' ?>
                        </h4>
                    </div>
                    <p class="text-gray-600 fs-6" style="text-align: justify;">
                        <?= $currentLang === 'en' ? 'Search for active job ads, monitor application status, receive digital offer letters and maintain daily timesheets.' : 'Carian iklan aktif, pemantauan status permohonan, penerimaan surat tawaran digital, serta log jam bekerja (<i>timesheet</i>) harian.' ?>
                    </p>
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-briefcase fs-2x text-primary me-3"><span class="path1"></span><span class="path2"></span></i>
                        <h4 class="text-gray-900 fw-bolder mb-0">
                            <?= $currentLang === 'en' ? 'PTJ Management' : 'Pengurusan PTJ' ?>
                        </h4>
                    </div>
                    <p class="text-gray-600 fs-6" style="text-align: justify;">
                        <?= $currentLang === 'en' ? 'Job advertising, applicant data management (manual/Excel batch), job budget approval and student task verification.' : 'Pengiklanan jawatan kosong, pengurusan data pemohon (manual/batch Excel), kelulusan bajet jawatan dan pengesahan tugasan pelajar.' ?>
                    </p>
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-chart-line fs-2x text-primary me-3"><span class="path1"></span><span class="path2"></span></i>
                        <h4 class="text-gray-900 fw-bolder mb-0">
                            <?= $currentLang === 'en' ? 'Control & Finance' : 'Kawalan & Kewangan' ?>
                        </h4>
                    </div>
                    <p class="text-gray-600 fs-6" style="text-align: justify;">
                        <?= $currentLang === 'en' ? 'Cross-monitoring of Career Unit annual budget allocation, applicant audit review and final approval of monthly allowance payments (Payroll).' : 'Pemantauan silang agihan peruntukan tahunan Unit Kerjaya, semakan audit pemohon, serta kelulusan akhir bayaran elaun bulanan (<i>Payroll</i>).' ?>
                    </p>
                </div>
            </div>

            <div class="separator separator-dashed border-gray-300 w-100 mt-10 mb-8"></div>

            <div class="text-gray-600 fs-7 fw-semibold">
                &copy; 2026 Pusat Teknologi Digital (DigitalUKM). All rights reserved.
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
<script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
<script id="lang-switch-ajax">
document.addEventListener('DOMContentLoaded', function () {
    const langLinks = document.querySelectorAll('a[href*="lang?lang="]');
    langLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            fetch(link.href, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(function () { window.location.reload(); })
            .catch(function () { window.location.href = link.href; });
        });
    });
});
</script>
