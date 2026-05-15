<?php
$metronic = base_url('assets/');
$sessionLang = session()->get('lang');
$currentLang = is_string($sessionLang) ? $sessionLang : 'ms';
$langName = $currentLang === 'ms' ? 'Bahasa Melayu' : 'English';
$langFlag = $currentLang === 'ms' ? 'malaysia.svg' : 'united-states.svg';
$title = $currentLang === 'ms' ? 'Lupa Kata Laluan' : 'Forgot Password';
$heroTitle = 'Job on Campus';
$subtitle = $currentLang === 'ms' ? 'Menyokong Kerjaya Pelajar Dalam Komuniti Universiti.' : 'Supporting Student Careers Within the University Community.';
$sendText = $currentLang === 'ms' ? 'Hantar Pautan Tetapan Semula' : 'Send Reset Link';
$backText = $currentLang === 'ms' ? 'Kembali ke' : 'Back to';
$loginText = $currentLang === 'ms' ? 'Log Masuk' : 'Login';
?>
<!DOCTYPE html>
<html lang="<?= esc($currentLang) ?>">
<head>
    <title>JoC System | <?= esc($title) ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/media/logos/JoCLogo-favicon.png?v=3') ?>" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/JoCLogo-favicon.png?v=3') ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= $metronic ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= $metronic ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        body, #kt_body {
            background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
            min-height: 100vh !important;
            margin: 0;
        }
        body::before, #kt_body::before, body::after, #kt_body::after { display:none !important; content:none !important; }
        .auth-panel { max-width: 600px !important; box-shadow: 0 10px 40px rgba(0,0,0,0.06) !important; border-radius: 1.25rem !important; }
        .auth-left-glass {
            width: min(600px, 100%);
            padding: 2.25rem;
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 1.25rem;
            background: rgba(255,255,255,.18);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
    </style>
</head>
<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <div class="auth-left-glass text-center">
                    <img class="mx-auto mw-100 w-150px w-lg-300px mb-5 mb-lg-10" src="<?= $metronic ?>media/auth/JobSearch.png" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-3"><?= esc($heroTitle) ?></h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold"><?= esc($subtitle) ?></div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-100 w-md-600px p-10 auth-panel">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-100 w-md-450px">
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                        <form class="form w-100" method="POST" action="<?= base_url('forgot-password') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="fp_lang" value="<?= esc($currentLang) ?>" />

                            <?php if (session('error')) : ?>
                                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                            <?php endif ?>

                            <?php if (session('errors')) : ?>
                                <div class="alert alert-danger" role="alert"><?= implode('<br>', session('errors')) ?></div>
                            <?php endif ?>

                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3"><?= esc($title) ?></h1>
                                <div class="text-gray-500 fw-semibold fs-6"><?= esc($subtitle) ?></div>
                            </div>

                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" required />
                            </div>

                            <div class="d-grid mb-6">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label"><?= esc($sendText) ?></span>
                                </button>
                            </div>

                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                <?= esc($backText) ?> <a href="<?= base_url('login') ?>" class="link-primary"><?= esc($loginText) ?></a>
                            </div>
                        </form>
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
</div>
<script src="<?= $metronic ?>plugins/global/plugins.bundle.js"></script>
<script src="<?= $metronic ?>js/scripts.bundle.js"></script>
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
</body>
</html>


