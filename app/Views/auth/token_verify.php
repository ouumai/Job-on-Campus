<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JoC System | Verify Account</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
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
                overflow: hidden;
            }
            .otp-input {
                width: 50px !important;
                height: 60px !important;
                font-size: 2rem !important;
                font-weight: bold !important;
                border: 2px solid var(--bs-gray-300) !important;
                background-color: var(--bs-gray-100) !important;
                border-radius: 0.75rem !important;
            }
            .otp-input:focus {
                border-color: var(--bs-primary) !important;
                background-color: #fff !important;
            }
        </style>
    </head>

    <body id="kt_body" class="auth-bg">
        <?php
            $lang = session()->get('lang') ?? 'ms';
            $isMs = ($lang === 'ms');
            $pageTitle = $isMs ? 'Sahkan Emel Anda' : 'Verify Your Email';
            $subTitle = $isMs ? 'Masukkan kod pengesahan yang dihantar ke' : 'Enter the verification code sent to';
            $otpLabel = $isMs ? 'Taipkan kod keselamatan 6 digit anda' : 'Type your 6-digit security code';
            $submitLabel = $isMs ? 'Sahkan Akaun' : 'Verify Account';
            $noCodeText = $isMs ? 'Tidak menerima kod?' : 'Did not receive code?';
            $resendText = $isMs ? 'Hantar Semula Emel' : 'Resend Email';
            $fallbackEmail = $isMs ? 'emel berdaftar anda' : 'your registered email';
            $langName = $isMs ? 'Bahasa Melayu' : 'English';
            $langFlag = $isMs ? 'malaysia.svg' : 'united-states.svg';

            // Fixed User Email Logic
            $userEmail = '';
            $currentUser = $user ?? auth()->user();
            if ($currentUser) {
                $userEmail = is_object($currentUser) ? $currentUser->email : ($currentUser['email'] ?? '');
            }
            
            if (empty($userEmail) && session()->has('user')) {
                $userSession = session('user');
                $userEmail = is_array($userSession) ? ($userSession['email'] ?? '') : '';
            }
        ?>

        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-10">
                
                <div class="bg-body d-flex flex-column rounded-4 w-100 w-md-500px token-shell">
                    
                    <?php if (session('error')) : ?>
                        <div class="otp-error-banner" style="width: calc(100% - 40px); margin: 20px 20px 0 20px; padding: 1rem; background-color: #fff5f8; border: 1px solid #f1416c; color: #d0003c; font-weight: 500; font-size: 0.95rem; text-align: center; border-radius: 0.475rem; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-exclamation-circle-fill me-3" style="font-size: 1.2rem; color: #f1416c;"></i>
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session('message')) : ?>
                        <div class="otp-success-banner" style="width: calc(100% - 40px); margin: 20px 20px 0 20px; padding: 1rem; background-color: #e8fff3; border: 1px solid #50cd89; color: #1ea97c; font-weight: 500; font-size: 0.95rem; text-align: left; border-radius: 0.475rem; display: flex; align-items: center;">
                            <i class="bi bi-check-circle-fill me-3" style="font-size: 1.2rem; color: #50cd89;"></i>
                            <?= session('message') ?>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex flex-center flex-column p-10">
                        <form class="form w-100 mb-10" method="POST" action="<?= base_url('verify-token') ?>" id="otp_form">
                            <?= csrf_field() ?>

                            <div class="text-center mb-10">
                                <div class="d-flex flex-center mx-auto mb-7" style="width: 100px; height: 100px; background-color: #f1faff; border-radius: 50%;">
                                    <i class="bi bi-inbox-fill text-primary" style="font-size: 3.5rem;"></i>
                                </div>
                            </div>

                            <div class="text-center mb-10">
                                <h1 class="text-gray-900 mb-3" style="font-size: 2.5rem;"><?= esc($pageTitle) ?></h1>
                                <div class="text-muted fw-semibold fs-5 mb-5"><?= esc($subTitle) ?></div>
                                <div class="fw-bold text-primary fs-3">
                                    <?= esc((string)($userEmail ?: $fallbackEmail)) ?>
                                </div>
                            </div>

                            <div class="mb-10">
                                <div class="fw-bold text-center text-gray-900 fs-6 mb-5"><?= esc($otpLabel) ?></div>
                                <div class="d-flex flex-stack justify-content-center mb-2">
                                    <input type="text" name="otp_field[]" maxlength="1" class="form-control otp-input mx-1 text-center" autofocus />
                                    <input type="text" name="otp_field[]" maxlength="1" class="form-control otp-input mx-1 text-center" />
                                    <input type="text" name="otp_field[]" maxlength="1" class="form-control otp-input mx-1 text-center" />
                                    <input type="text" name="otp_field[]" maxlength="1" class="form-control otp-input mx-1 text-center" />
                                    <input type="text" name="otp_field[]" maxlength="1" class="form-control otp-input mx-1 text-center" />
                                    <input type="text" name="otp_field[]" maxlength="1" class="form-control otp-input mx-1 text-center" />
                                </div>
                                <input type="hidden" name="token" id="full_token_input" />
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary fw-bold w-100">
                                <?= esc($submitLabel) ?>
                            </button>
                        </form>

                        <div class="text-center fw-semibold fs-5 mb-10">
                            <span class="text-muted me-1"><?= esc($noCodeText) ?></span>
                            <a href="<?= base_url('resend-otp') ?>" class="link-primary fs-5"><?= esc($resendText) ?></a>
                        </div>

                        <div class="me-10">
                            <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary fs-base px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                <img class="w-20px h-20px rounded me-3" src="<?= base_url('assets/media/flags/' . $langFlag) ?>" />
                                <span class="me-1"><?= esc($langName) ?></span>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 w-200px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="<?= base_url('lang?lang=en') ?>" class="menu-link px-5">English</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="<?= base_url('lang?lang=ms') ?>" class="menu-link px-5">Bahasa Melayu</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
        <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const otpInputs = document.querySelectorAll('.otp-input');
                const fullTokenInput = document.getElementById('full_token_input');

                otpInputs.forEach((input, index) => {
                    input.addEventListener('input', (e) => {
                        if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                        updateFullToken();
                    });
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && !e.target.value && index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    });
                });

                function updateFullToken() {
                    let combinedValue = "";
                    otpInputs.forEach(input => combinedValue += input.value);
                    fullTokenInput.value = combinedValue;
                }
            });
        </script>
    </body>
</html>