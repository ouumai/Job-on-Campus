<?php
$metronic = base_url('assets/');
$currentLang = session()->get('lang') ?? 'en';
$title = $currentLang === 'ms' ? 'Semak Emel Anda' : 'Check Your Email';
$desc = $currentLang === 'ms'
    ? 'Jika emel wujud dalam sistem, pautan log masuk automatik telah dihantar.'
    : 'If the email exists in our system, a password reset link has been sent.';
$backBtn = $currentLang === 'ms' ? 'Kembali ke Log Masuk' : 'Back to Login';
$langName = $currentLang === 'ms' ? 'Bahasa Melayu' : 'English';
$langFlag = $currentLang === 'ms' ? 'malaysia.svg' : 'united-states.svg';
?>
<!DOCTYPE html>
<html lang="<?= esc($currentLang) ?>">
<head>
    <title>JoC System | <?= esc($title) ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= $metronic ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= $metronic ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        html, body, #kt_body {
            background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .token-shell {
            max-width: 500px !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06) !important;
            border-radius: 1.25rem !important;
        }
    </style>
</head>
<body id="kt_body" class="auth-bg">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-10">
        <div class="bg-body d-flex flex-column rounded-4 w-100 w-md-500px p-10 token-shell">
            <div class="d-flex flex-center flex-column">
                <div class="text-center mb-10">
                    <div class="d-flex flex-center mx-auto mb-7" style="width: 100px; height: 100px; background-color: #f1faff; border-radius: 50%;">
                        <i class="bi bi-inbox-fill text-primary" style="font-size: 3.5rem;"></i>
                    </div>
                </div>

                <div class="text-center mb-10">
                    <h1 class="text-gray-900 mb-3" style="font-size: 2.5rem; text-align:center;"><?= esc($title) ?></h1>
                    <div class="text-muted fw-semibold fs-5 mb-5" style="text-align:center;"><?= esc($desc) ?></div>
                </div>

                <div class="d-flex flex-center w-100 mb-10">
                    <a href="<?= base_url('login') ?>" class="btn btn-lg btn-primary fw-bold w-100"><?= esc($backBtn) ?></a>
                </div>

                <div class="d-flex flex-stack">
                    <div class="me-10">
                        <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                            <img class="w-20px h-20px rounded me-3" src="<?= $metronic ?>media/flags/<?= esc($langFlag) ?>" alt="lang" />
                            <span class="me-1"><?= esc($langName) ?></span>
                            <span class="svg-icon svg-icon-5 text-muted rotate-180 m-0" aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="<?= base_url('lang?lang=en') ?>" class="menu-link d-flex px-5">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="<?= $metronic ?>media/flags/united-states.svg" alt="EN" />
                                    </span>
                                    <span>English</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="<?= base_url('lang?lang=ms') ?>" class="menu-link d-flex px-5">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="<?= $metronic ?>media/flags/malaysia.svg" alt="MS" />
                                    </span>
                                    <span>Bahasa Melayu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= $metronic ?>plugins/global/plugins.bundle.js"></script>
<script src="<?= $metronic ?>js/scripts.bundle.js"></script>
</body>
</html>
