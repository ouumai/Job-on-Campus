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
    }

    .footer-text {
        color: #444 !important; /* Warna text supaya jelas */
        font-weight: 500;
		z-index: 900 !important;
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

                                    <?php elseif (auth()->user()->inGroup('supervisor')): ?>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('dashboard') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_main_dashboard') ?></span>
                                            </a>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_job_management') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/iklan/senarai') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_my_ads') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/iklan/form') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_create_ad') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_candidate_recruitment') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/calon/senarai') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_candidate_list') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/calon/import') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_import_candidates') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_ptj_approval') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/bajet_ptj') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_ptj_ad_approval') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/ketua_projek') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_fund_approval') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_review_reports') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/semakan') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_student_work_verification') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('penyelia/laporan_ptj') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_ptj_report') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif (auth()->user()->inGroup('career')): ?>
                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('dashboard') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_main_statistics') ?></span>
                                            </a>
                                        </div>

                                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                                            <span class="menu-link py-3">
                                                <span class="menu-title"><?= lang('Joc.nav_ads_monitoring') ?></span>
                                                <i class="fa-solid fa-chevron-down ms-2 fs-8"></i>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('urusetia/iklan/senarai') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_all_system_ads') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('urusetia/iklan/form') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_career_ad_form') ?></span>
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link py-3" href="<?= site_url('urusetia/iklan/calon_senarai') ?>">
                                                        <span class="menu-title"><?= lang('Joc.nav_applicant_audit') ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('kelulusan/senarai') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_approval_inbox') ?></span>
                                            </a>
                                        </div>

                                        <div class="menu-item me-lg-1">
                                            <a class="menu-link py-3" href="<?= site_url('pengguna/bajet') ?>">
                                                <span class="menu-title"><?= lang('Joc.nav_budget_management') ?></span>
                                            </a>
                                        </div>
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
                                    $flag = ($currentLang == 'en') ? 'united-states.svg' : 'malaysia.svg';
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
                                            <span class="symbol symbol-20px me-4"><img class="rounded-1" src="<?= base_url('assets/media/flags/united-states.svg') ?>" alt="English" /></span>
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
                                        if (empty(trim($initials))) {
                                            $initials = strtoupper(substr($user->username ?? 'U', 0, 2));
                                        }
                                    } else {
                                        $initials = 'G';
                                    }
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
                                                <div class="fw-bold d-flex align-items-center fs-5"><?= esc($user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : 'Guest') ?></div>
                                                <?php 
                                                    $roleGroups = $user ? ($user->getGroups() ?: ['guest']) : ['guest'];
                                                    $roleMap = [
                                                        'student' => 'Joc.role_student',
                                                        'supervisor' => 'Joc.role_supervisor',
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
                                                ?>
                                                <div class="mt-1">
                                                    <span class="badge badge-light-info fw-bold fs-8 px-2 py-1 text-capitalize">
                                                        <?= esc($roleText) ?>
                                                    </span>
                                                </div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7 mt-1"><?= esc($user->email ?? '') ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5"><a href="<?= site_url('user/profile') ?>" class="menu-link px-5"><?= lang('Joc.nav_profile') ?></a></div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5"><a href="<?= site_url('logout') ?>" class="menu-link px-5 text-danger logout-link"><?= lang('Joc.nav_logout') ?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <div class="page-title d-flex flex-column me-3">
                            <h1 class="d-flex text-dark fw-bold my-1 fs-3"><?= $this->renderSection('page-title') ?></h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                                <li class="breadcrumb-item text-dark opacity-75"><a href="<?= site_url('dashboard') ?>" class="text-dark text-hover-primary"><?= lang('Joc.nav_home') ?></a></li>
                                <li class="breadcrumb-item"><span class="bullet bg-dark opacity-75 w-5px h-2px"></span></li>
                                <li class="breadcrumb-item text-dark opacity-75"><?= $this->renderSection('breadcrumb') ?></li>
                            </ul>
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
						<span>&copy; 2026 Pusat Teknologi Digital (DigitalUKM). All rights reserved.</span>
					</div>
				</div>
			</div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <script>
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
    <?= $this->renderSection('extra-js') ?>
</body>
</html>