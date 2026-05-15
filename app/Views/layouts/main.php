<!DOCTYPE html>
<html lang="<?= session('lang') ?? 'en' ?>">
<head>
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | JoC System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <?= $this->renderSection('extra-css') ?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                
                <div id="kt_header" class="header align-items-stretch">
                    <div class="container-xxl d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <?php if (auth()->user()->inGroup('student')): ?>
                                <a href="<?= site_url('pelajar/semakan') ?>" class="menu-link px-3"><?= lang('Joc.menu_dashboard') ?></a>
                                <a href="<?= site_url('pelajar/mohon') ?>" class="menu-link px-3"><?= lang('Joc.menu_apply') ?></a>
                            <?php elseif (auth()->user()->inGroup('supervisor')): ?>
                                <a href="<?= site_url('penyelia/iklan') ?>" class="menu-link px-3"><?= lang('Joc.menu_ads') ?></a>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="btn btn-icon btn-active-light-primary position-relative me-3">
                                <i class="bi bi-bell fs-2"></i>
                                <span class="badge badge-circle badge-danger position-absolute top-0 start-100 translate-middle">5</span>
                            </div>
                            
                            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click">
                                <img src="<?= base_url('assets/media/avatars/300-1.jpg') ?>" alt="user" />
                            </div>
                            </div>
                    </div>
                </div>

                <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <div class="page-title d-flex flex-column me-3">
                            <h1 class="d-flex text-white fw-bold my-1 fs-3"><?= $this->renderSection('page-title') ?></h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                                <li class="breadcrumb-item text-white opacity-75">Home</li>
                                <li class="breadcrumb-item"><span class="bullet bg-white opacity-75 w-5px h-2px"></span></li>
                                <li class="breadcrumb-item text-white opacity-75"><?= $this->renderSection('breadcrumb') ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <div class="content flex-row-fluid" id="kt_content">
                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
                        <?php endif; ?>

                        <?= $this->renderSection('content') ?>
                    </div>
                </div>

                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-gray-900 order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2026&copy;</span>
                            <a href="#" class="text-gray-800 text-hover-primary">JoC System UKM</a>
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