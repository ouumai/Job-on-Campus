<?php use App\Models\NotifikasiModel; ?>
<!DOCTYPE html>
<html lang="<?= session('lang') ?? 'ms' ?>">
<head>
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | JoC System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/JoCLogo.png') ?>" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    
    <style>
        /* 1. Background Gradient Keseluruhan (Ikut Style Login) */
        .wrapper {
            background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
            background-attachment: fixed !important;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #kt_wrapper {
            min-height: 100vh;
        }

        #kt_content_container {
            flex: 1 0 auto;
            width: 100%;
            padding-bottom: 1rem;
        }

        /* 2. Nav Bar (Header) dengan Background Glassmorphism */
        #kt_header {
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        z-index: 1000 !important; 
    }

        /* 3. Pastikan Toolbar & Content telus */
        .toolbar, .content {
            background: transparent !important;
        }

        .page-heading {
            color: #1f2937 !important;
            font-size: 2rem !important;
            font-weight: 700 !important;
            line-height: 1.2;
            margin-bottom: 0.35rem !important;
        }


        /* Buang lapisan geometri asal Metronic */
        .wrapper::before, .wrapper::after {
            display: none !important;
        }

        /* Ejas sikit warna text menu supaya kontra dengan background cerah */
        .menu-link .menu-title, .menu-link i.fa-chevron-down {
            color: #444 !important;
        }
        
        .menu-item:hover > .menu-link .menu-title,
        .menu-item.here > .menu-link .menu-title,
        .menu-item:hover > .menu-link i.fa-chevron-down,
        .menu-item.here > .menu-link i.fa-chevron-down {
            color: #ffffff !important;
        }

        /* Style hover submenu macam language switcher (bg biru cair, text biru) */
        .menu-sub .menu-item > .menu-link {
            border-radius: 0.475rem;
            transition: all 0.2s ease;
        }

        .menu-sub .menu-item:hover > .menu-link,
        .menu-sub .menu-item.here > .menu-link {
            background-color: #f1faff !important;
        }

        .menu-sub .menu-item:hover > .menu-link .menu-title,
        .menu-sub .menu-item.here > .menu-link .menu-title {
            color: #009ef7 !important;
        }

        .menu-item .menu-link.logout-link:hover {
            background-color: rgba(241, 65, 108, 0.1) !important;
            color: #f1416c !important;
        }

        .notification-button {
            transition: all .2s ease-in-out;
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
            width: 48px !important;
            height: 48px !important;
            min-width: 48px !important;
            min-height: 48px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 !important;
            font-size: 1.6rem;
            color: #444 !important;
        }

        .notification-button i {
            transition: color .2s ease-in-out;
            font-size: 1.6rem;
            display: block;
            width: 100%;
            text-align: center;
        }

        .notification-button:hover,
        .notification-button.show,
        .notification-button:focus,
        .notification-button:active {
            color: #ffffff !important;
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .notification-button:hover i,
        .notification-button.show i,
        .notification-button:focus i,
        .notification-button:active i {
            color: #ffffff !important;
        }

        .language-toggle {
            transition: all .2s ease-in-out;
            min-width: 90px;
            color: #444 !important;
        }
        
        .language-toggle span {
            color: inherit;
        }

        .language-toggle:hover,
        .language-toggle.show,
        .language-toggle:focus,
        .language-toggle:active {
            color: #ffffff !important;
            background-color: transparent !important;
        }

        .language-toggle:hover span,
        .language-toggle.show span,
        .language-toggle:focus span,
        .language-toggle:active span {
            color: #ffffff !important;
        }

		#kt_footer {
        background: rgba(255, 255, 255, 0.15) !important; /* Background lutsinar */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: auto;
        position: relative;
        z-index: 2;
    }

        .footer-text {
        color: #444 !important; /* Warna text supaya jelas */
        font-weight: 500;
		z-index: 900 !important;
    }

    .user-email-dropdown {
        display: block;
        max-width: 100%;
        overflow-wrap: anywhere;
        word-break: break-word;
        white-space: normal;
        line-height: 1.35;
    }
    </style>

    <?= $this->renderSection('extra-css') ?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                
                <div id="kt_header" class="header align-items-stretch" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <div class="container-xxl d-flex align-items-center justify-content-between">
                        
                        <div class="d-flex align-items-center gap-3 me-5">
                            <i class="ki-duotone ki-teacher fs-1 text-primary">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <span class="fs-4 fw-bolder text-gray-900 tracking-tight d-none d-sm-inline">Job on Campus (JoC)</span>
                        </div>

                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                            <div class="header-menu align-items-stretch">
                                <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold my-5 my-lg-0" id="#kt_header_menu" data-kt-menu="true">
                                    
                                    <?php 
                                        $user = auth()->user();
                                        $isMsNav = (session('lang') ?? 'ms') === 'ms';
                                        if (! isset($isUrusetia)) {
                                            $isUrusetia = false;
                                            if ($user && ! $user->inGroup('student')) {
                                                $urusetiaModel = model(\App\Models\UrusetiaModel::class);
                                                $checkUrusetia = $urusetiaModel->getByUkmper((string) ($user->username ?? ''));
                                                if ($checkUrusetia && (int) (($checkUrusetia->aktif ?? 0)) === 1) {
                                                    $isUrusetia = true;
                                                }
                                            }
                                        }
                                        if ($user && $user->inGroup('student')): 
                                    ?>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('dashboard') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_main_dashboard') ?></span>
                                            </a>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_search_jobs') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('pelajar/iklan_senarai') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_active_ads') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('pelajar/permohonan_senarai') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_application_records') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('pelajar/surat_senarai') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_job_offers') ?></span>
                                            </a>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_job_log') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('pelajar/timesheet_form') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_timesheet_form') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('pelajar/claim_form') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_claim_form') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($user && ! $user->inGroup('student')): ?>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('dashboard') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_main_dashboard') ?></span>
                                            </a>
                                        </div>

                                        <?php if ($isUrusetia): ?>
                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Pemantauan Iklan' : 'Ad Monitoring' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('urusetia/iklan/senarai') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Semua Iklan (Sistem)' : 'All Ads (System)' ?></span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('urusetia/iklan/calon_senarai') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Semakan Pemohon (Audit)' : 'Applicant Review (Audit)' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Kelulusan' : 'Approvals' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('kelulusan/senarai') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Kelulusan Iklan & Payroll' : 'Ad & Payroll Approval' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Kewangan' : 'Finance' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('pengguna/bajet') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Pengurusan Bajet Kerjaya' : 'Career Budget Management' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Pengurusan Iklan' : 'Ad Management' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/iklan/senarai') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Iklan Saya' : 'My Ads' ?></span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/iklan/form') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Cipta Iklan Baru' : 'Create New Ad' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Pengambilan Calon' : 'Candidate Intake' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/calon/senarai') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Senarai Calon' : 'Candidate List' ?></span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/calon/import') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Import Calon (Excel)' : 'Import Candidates (Excel)' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Kelulusan (Peringkat PTJ)' : 'Approvals (PTJ Level)' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/bajet_ptj') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Kelulusan Iklan PTJ (Ketua Projek)' : 'PTJ Ad Approval (Project Lead)' ?></span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/ketua_projek') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Kelulusan Dana Tabung (Ketua Projek)' : 'Fund Approval (Project Lead)' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                                <span class="menu-link py-3">
                                                    <span class="menu-title"><?= $isMsNav ? 'Semakan & Laporan' : 'Review & Reports' ?></span>
                                                    <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                                </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/semakan') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Pengesahan Kerja Pelajar' : 'Student Work Verification' ?></span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link py-3" href="<?= site_url('penyelia/laporan_ptj') ?>">
                                                            <span class="menu-title"><?= $isMsNav ? 'Laporan Statistik PTJ' : 'PTJ Statistical Report' ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-shrink-0">
                            
                            <div class="d-flex align-items-center ms-0 ms-lg-0">
                                <?php 
                                    $notifModel = model(NotifikasiModel::class);
                                    $user = auth()->user();
                                    $unreadCount = $notifModel->countUnread($user->matrik ?? $user->id);
                                ?>
                                <div class="btn btn-icon position-relative notification-button" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fa-duotone fa-solid fa-bell"></i>
                                    <?php if ($unreadCount > 0): ?>
                                        <span class="badge badge-circle badge-danger position-absolute top-0 start-100 translate-middle fs-9">
                                            <?= $unreadCount > 99 ? '99+' : $unreadCount ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-flex align-items-center ms-1 ms-lg-1">
                                <?php 
                                    $currentLang = session('lang') ?? 'ms';
                                    $flag = ($currentLang == 'en') ? 'united-kingdom.svg' : 'malaysia.svg';
                                    $langName = ($currentLang == 'en') ? lang('Joc.language_english') : lang('Joc.language_malay');
                                ?>
                                <button class="btn btn-flex btn-link rotate fs-base px-0 language-toggle" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-offset="0px,0px">
                                    <img class="w-20px h-20px rounded me-3" src="<?= base_url('assets/media/flags/' . $flag) ?>" alt="lang" />
                                    <span class="me-1 d-none d-md-inline"><?= esc($langName) ?></span>
                                    <span class="svg-icon svg-icon-5 rotate-180 m-0" aria-hidden="true">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </button>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 fs-7 w-200px" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="<?= site_url('lang?lang=en') ?>" class="menu-link d-flex px-5 <?= ($currentLang == 'en') ? 'active' : '' ?>" data-kt-lang="en">
                                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/united-kingdom.svg') ?>" alt="English" /></span>
                                            <span><?= lang('Joc.language_english') ?></span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="<?= site_url('lang?lang=ms') ?>" class="menu-link d-flex px-5 <?= ($currentLang == 'ms') ? 'active' : '' ?>" data-kt-lang="ms">
                                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/malaysia.svg') ?>" alt="Bahasa Melayu" /></span>
                                            <span><?= lang('Joc.language_malay') ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                <?php 
                                    if ($user) {
                                        $firstName = $user->first_name ?? '';
                                        $lastName = $user->last_name ?? '';
                                        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                        $profileImage = trim((string) ($user->profile_image ?? ''));
                                        $avatarUrl = $profileImage !== '' ? base_url($profileImage) : null;
                                        if (empty(trim($initials))) {
                                            $initials = strtoupper(substr($user->username ?? 'U', 0, 2));
                                        }
                                    } else {
                                        $initials = 'G';
                                        $avatarUrl = null;
                                    }
                                ?>
                                <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <?php if ($avatarUrl): ?>
                                        <img src="<?= esc($avatarUrl) ?>" alt="Avatar" class="symbol-label object-fit-cover" />
                                    <?php else: ?>
                                        <div class="symbol-label fs-3 bg-light-primary text-primary fw-bold"><?= esc($initials) ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <?php if ($avatarUrl): ?>
                                                    <img src="<?= esc($avatarUrl) ?>" alt="Avatar" class="symbol-label object-fit-cover" />
                                                <?php else: ?>
                                                    <div class="symbol-label fs-2 bg-light-primary text-primary fw-bold"><?= esc($initials) ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5"><?= esc($user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : 'Guest') ?></div>
                                                <?php 
                                                    $isMsLang = (session('lang') ?? 'ms') === 'ms';
                                                    if (isset($isUrusetia) && $isUrusetia) {
                                                        $roleText = $isMsLang ? 'Urusetia' : 'Secretariat';
                                                        $badgeClass = 'badge-light-warning';
                                                    } elseif ($user && $user->inGroup('supervisor')) {
                                                        $roleText = $isMsLang ? 'Penyelia' : 'Supervisor';
                                                        $badgeClass = 'badge-light-success';
                                                    } elseif ($user && $user->inGroup('student')) {
                                                        $roleText = lang('Joc.role_student');
                                                        $badgeClass = 'badge-light-info';
                                                    } else {
                                                        $roleGroups = $user ? ($user->getGroups() ?: ['guest']) : ['guest'];
                                                        $roleMap = [
                                                            'career' => 'Joc.role_career',
                                                            'admin' => 'Joc.role_admin',
                                                            'guest' => 'Joc.role_guest',
                                                        ];
                                                        $roleLabels = array_map(function ($group) use ($roleMap) {
                                                            $key = strtolower($group);
                                                            if (isset($roleMap[$key])) {
                                                                return lang($roleMap[$key]);
                                                            }
                                                            return ucfirst(str_replace(['-', '_'], ' ', $group));
                                                        }, $roleGroups);
                                                        $roleText = implode(', ', $roleLabels);
                                                        $badgeClass = 'badge-light-info';
                                                    }
                                                ?>
                                                <div class="mt-1">
                                                    <span class="badge <?= $badgeClass ?> fw-bold fs-8 px-2 py-1 text-capitalize">
                                                        <?= esc($roleText) ?>
                                                    </span>
                                                </div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7 mt-1 user-email-dropdown"><?= esc($user->email ?? '') ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5"><a href="<?= site_url('profil') ?>" class="menu-link px-5"><?= lang('Joc.nav_profile') ?></a></div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5">
                                        <a
                                            href="<?= site_url('logout') ?>"
                                            class="menu-link px-5 text-danger logout-link"
                                            data-risk-confirm="1"
                                            data-confirm-message-ms="Adakah anda pasti mahu log keluar?"
                                            data-confirm-message-en="Are you sure you want to log out?"
                                        ><?= lang('Joc.nav_logout') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <?php
                            $pageTitle = trim($this->renderSection('page-title'));
                            if ($pageTitle === '') {
                                $pageTitle = trim($this->renderSection('title'));
                            }
                            if ($pageTitle === '') {
                                $pageTitle = 'Dashboard';
                            }
                        ?>
                        <div class="page-title d-flex flex-column me-3">
                            <h1 class="page-heading"><?= esc($pageTitle) ?></h1>
                        </div>
                    </div>
                </div>

                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <div class="content flex-row-fluid" id="kt_content">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>

                <div class="footer py-6 d-flex flex-lg-column" id="kt_footer">
				<div class="container-xxl text-center">
					<div class="footer-text">
						<span>
                            &copy; 2026 Pusat Teknologi Digital (DigitalUKM).
                            <?= (session('lang') ?? 'ms') === 'ms' ? 'Hak cipta terpelihara.' : 'All rights reserved.' ?>
                        </span>
					</div>
				</div>
			</div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <script>
    window.JocConfirmRisk = function (options) {
        const opts = options || {};
        const title = opts.title || 'Are you sure?';
        const text = opts.text || '';
        const confirmText = opts.confirmText || 'Yes';
        const cancelText = opts.cancelText || 'Cancel';

        if (typeof window.Swal !== 'undefined') {
            return window.Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                buttonsStyling: false,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                width: 460,
                padding: '1.75rem',
                customClass: {
                    popup: 'joc-risk-popup',
                    title: 'joc-risk-popup-title',
                    htmlContainer: 'joc-risk-popup-text',
                    confirmButton: 'btn joc-risk-confirm-btn',
                    cancelButton: 'btn btn-light joc-risk-cancel-btn',
                    closeButton: 'joc-risk-close-btn',
                    actions: 'joc-risk-actions'
                },
                didOpen: function (el) {
                    const closeBtn = el.querySelector('.swal2-close');
                    if (closeBtn) closeBtn.setAttribute('aria-label', 'Close');
                }
            }).then(function (result) {
                return !!result.isConfirmed;
            });
        }

        return Promise.resolve(window.confirm([title, text].filter(Boolean).join('\n')));
    };

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

        document.addEventListener('click', function (e) {
            const target = e.target.closest('[data-risk-confirm="1"]');
            if (!target) return;

            e.preventDefault();
            e.stopPropagation();

            const isMs = '<?= (session('lang') ?? 'ms') === 'ms' ? '1' : '0' ?>' === '1';
            const title = isMs ? 'Pengesahan Tindakan' : 'Action Confirmation';
            const message = isMs
                ? (target.getAttribute('data-confirm-message-ms') || 'Adakah anda pasti?')
                : (target.getAttribute('data-confirm-message-en') || 'Are you sure?');
            const confirmText = isMs ? 'Ya, teruskan' : 'Yes, proceed';
            const cancelText = isMs ? 'Batal' : 'Cancel';

            window.JocConfirmRisk({
                title: title,
                text: message,
                confirmText: confirmText,
                cancelText: cancelText
            }).then(function (confirmed) {
                if (!confirmed) return;

                const href = target.getAttribute('href');
                if (href && href !== '#') {
                    window.location.href = href;
                    return;
                }

                if (target.closest('form')) {
                    target.closest('form').submit();
                }
            });
        }, true);
    });
    </script>
    <style>
    .swal2-popup.joc-risk-popup {
        border-radius: 24px !important;
        box-shadow: 0 20px 50px rgba(22, 34, 66, 0.18) !important;
    }

    .joc-risk-popup-title {
        font-weight: 800 !important;
        letter-spacing: 0.2px;
    }

    .joc-risk-popup-text {
        color: #5e6278 !important;
        line-height: 1.6 !important;
    }

    .swal2-actions.joc-risk-actions {
        width: 100%;
        display: flex !important;
        justify-content: center;
        gap: 14px;
        margin-top: 1.25rem !important;
    }

    .joc-risk-confirm-btn,
    .joc-risk-cancel-btn {
        min-width: 140px;
        border-radius: 12px !important;
        padding: 0.75rem 1rem !important;
        font-weight: 700 !important;
    }

    .joc-risk-confirm-btn {
        background: #4169E1 !important;
        border: 1px solid #4169E1 !important;
        color: #ffffff !important;
    }

    .joc-risk-confirm-btn:hover {
        background: #6495ED !important;
        border-color: #6495ED !important;
        color: #ffffff !important;
    }

    .swal2-close.joc-risk-close-btn {
        color: #FF0000 !important;
        font-size: 1.75rem !important;
        right: 0.75rem !important;
        top: 0.6rem !important;
    }

    .swal2-close.joc-risk-close-btn:hover {
        color: #FF0000 !important;
        background: #FFEDF0 !important;
        border-radius: 100px;
    }
    </style>
    <?= $this->renderSection('extra-js') ?>
</body>
</html>
