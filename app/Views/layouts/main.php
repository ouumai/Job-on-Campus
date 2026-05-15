<?php use App\Models\NotifikasiModel; ?>
<!DOCTYPE html>
<html lang="<?= session('lang') ?? 'ms' ?>">
<head>
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | JoC System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    
    <?= $this->renderSection('extra-css') ?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                
                <div id="kt_header" class="header align-items-stretch" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <div class="container-xxl d-flex align-items-center justify-content-between">
                        
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                            <div class="header-menu align-items-stretch">
                                <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold my-5 my-lg-0" id="#kt_header_menu" data-kt-menu="true">
                                    
                                    <div class="menu-item me-lg-1">
                                        <a class="menu-link py-3" href="<?= site_url('dashboard') ?>">
                                            <span class="menu-title"><?= lang('Joc.nav_dashboard') ?></span>
                                        </a>
                                    </div>

                                    <?php if (auth()->user()->inGroup('student')): ?>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('pelajar/mohon') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_job_ads') ?></span>
                                            </a>
                                        </div>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('pelajar/semakan') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_my_status') ?></span>
                                            </a>
                                        </div>

                                    <?php elseif (auth()->user()->inGroup('supervisor')): ?>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('penyelia/iklan') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_my_ads') ?></span>
                                            </a>
                                        </div>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('penyelia/semakan') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_verification') ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-shrink-0">
                            
                            <div class="d-flex align-items-center ms-1 ms-lg-3">
                                <?php 
                                    $notifModel = model(NotifikasiModel::class);
                                    $user = auth()->user();
                                    $unreadCount = $notifModel->countUnread($user->matrik ?? $user->id);
                                ?>
                                <div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-notification-on fs-2">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                    </i>
                                    <?php if ($unreadCount > 0): ?>
                                        <span class="badge badge-circle badge-danger position-absolute top-0 start-100 translate-middle fs-9">
                                            <?= $unreadCount > 99 ? '99+' : $unreadCount ?> 
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-flex align-items-center ms-1 ms-lg-3">
                                <?php 
                                    $currentLang = session('lang') ?? 'ms';
                                    $flag = ($currentLang == 'en') ? 'united-states.svg' : 'malaysia.svg';
                                ?>
                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <img class="h-20px w-20px rounded-sm" src="<?= base_url('assets/media/flags/' . $flag) ?>" alt="lang" />
                                </button>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px" data-kt-menu="true">
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

                            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                <?php 
                                    $user = auth()->user();
                                    $initials = strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1));
                                ?>
                                <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <div class="symbol-label fs-3 bg-light-primary text-primary fw-bold"><?= esc($initials) ?></div>
                                </div>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <div class="symbol-label fs-2 bg-light-primary text-primary fw-bold"><?= esc($initials) ?></div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5"><?= esc($user->first_name . ' ' . $user->last_name) ?></div>
                                                <div class="mt-1">
                                                    <span class="badge badge-light-info fw-bold fs-8 px-2 py-1 text-capitalize">
                                                        <?= esc(strtolower($user->group ?? 'guest')) ?>
                                                    </span>
                                                </div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7 mt-1"><?= esc($user->email) ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5"><a href="<?= site_url('user/profile') ?>" class="menu-link px-5">Profil Saya</a></div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5"><a href="<?= site_url('logout') ?>" class="menu-link px-5 text-danger">Log Keluar</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <div class="page-title d-flex flex-column me-3">
                            <h1 class="d-flex text-white fw-bold my-1 fs-3"><?= $this->renderSection('page-title') ?></h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                                <li class="breadcrumb-item text-white opacity-75"><a href="<?= site_url('dashboard') ?>" class="text-white text-hover-primary">Home</a></li>
                                <li class="breadcrumb-item"><span class="bullet bg-white opacity-75 w-5px h-2px"></span></li>
                                <li class="breadcrumb-item text-white opacity-75"><?= $this->renderSection('breadcrumb') ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <div class="content flex-row-fluid" id="kt_content">
                        <?php if (session('success')): ?>
                            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                <i class="ki-duotone ki-check-circle fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex flex-column"><span><?= session('success') ?></span></div>
                            </div>
                        <?php endif; ?>
                        
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>

                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-gray-900 order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2026&copy;</span>
                            <a href="#" class="text-gray-800 text-hover-primary">JoC System v1.6</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <?= $this->renderSection('extra-js') ?>
</body>
</html>