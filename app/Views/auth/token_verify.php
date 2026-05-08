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
            }
            /* Style khas untuk kotak OTP */
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
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-10">
                
                <div class="bg-body d-flex flex-column rounded-4 w-100 w-md-500px p-10 token-shell">
                    <div class="d-flex flex-center flex-column">
                        
                        <form class="form w-100 mb-10" novalidate="novalidate" method="POST" action="<?= url_to('auth-action-verify') ?>" id="otp_form">
                            <?= csrf_field() ?>

                            <?php if (session('error')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session('error') ?>
                                </div>
                            <?php endif ?>

                            <?php if (session('message')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('message') ?>
                                </div>
                            <?php endif ?>

                            <div class="text-center mb-10">
                                <div class="d-flex flex-center mx-auto mb-7" style="width: 100px; height: 100px; background-color: #f1faff; border-radius: 50%;">
                                    <i class="bi bi-inbox-fill text-primary" style="font-size: 3.5rem;"></i>
                                </div>
                            </div>

                            <div class="text-center mb-10">
                                <h1 class="text-gray-900 mb-3" data-kt-translate="two-step-title" style="font-size: 2.5rem;">Verify Your Email</h1>
                                <div class="text-muted fw-semibold fs-5 mb-5" data-kt-translate="two-step-desc">Enter the verification code we sent to</div>

                                <div class="fw-bold text-primary fs-3">
                                <?php 
                                    $userEmail = 'your registered email';
                                    
                                    if (isset($user)) {
                                        if (is_object($user) && isset($user->email)) {
                                            $userEmail = $user->email;
                                        } elseif (is_array($user) && isset($user['email'])) {
                                            $userEmail = $user['email'];
                                        }
                                    } elseif (function_exists('auth')) {
                                        try {
                                            $authenticator = auth('session')->getAuthenticator();
                                            if (method_exists($authenticator, 'getPendingUser')) {
                                                $pendingUser = $authenticator->getPendingUser();
                                                if ($pendingUser && isset($pendingUser->email)) {
                                                    $userEmail = $pendingUser->email;
                                                }
                                            }
                                        } catch (\Throwable $e) {}
                                    }
                                    
                                    if ($userEmail === 'your registered email' && session()->has('user') && is_array(session('user')) && isset(session('user')['email'])) {
                                        $userEmail = session('user')['email'];
                                    }
                                    
                                    // Ensure $userEmail is strictly a string and not null to avoid esc() or htmlspecialchars() errors
                                    if (empty($userEmail) || !is_string($userEmail)) {
                                        $userEmail = 'your registered email';
                                    }
                                    
                                    echo esc($userEmail);
                                ?>
                                </div>
                            </div>

                            <div class="mb-10">
                                <div class="fw-bold text-center text-gray-900 fs-6 mb-5" data-kt-translate="two-step-input-label">Type your 6 digit security code</div>
                                
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

                            <div class="d-flex flex-center">
                                <button type="submit" class="btn btn-lg btn-primary fw-bold w-100">
                                    <span class="indicator-label" data-kt-translate="two-step-submit">Verify Account</span>
                                </button>
                            </div>
                        </form>

                        <div class="text-center fw-semibold fs-5 mb-10">
                            <span class="text-muted me-1" data-kt-translate="two-step-resend-text">Didn’t get the code?</span>
                            <a href="<?= url_to('auth-action-show') ?>" class="link-primary fs-5" data-kt-translate="two-step-resend-link">Resend Email</a>
                        </div>

                        <div class="mb-2">
                            <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="<?= base_url('assets/media/flags/united-states.svg') ?>" alt="" />
                                <span data-kt-element="current-lang-name" class="me-1">English</span>
                                <span class="svg-icon svg-icon-5 text-muted rotate-180 m-0">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="eng">
                                        <span class="symbol symbol-20px me-4">
                                            <img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url('assets/media/flags/united-states.svg') ?>" alt="" />
                                        </span>
                                        <span data-kt-element="lang-name">English</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="ms">
                                        <span class="symbol symbol-20px me-4">
                                            <img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url('assets/media/flags/malaysia.svg') ?>" alt="" />
                                        </span>
                                        <span data-kt-element="lang-name">Bahasa Melayu</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
        <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
        <script src="<?= base_url('assets/js/custom/authentication/sign-in/i18n.js') ?>"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const otpInputs = document.querySelectorAll('.otp-input');
                const fullTokenInput = document.getElementById('full_token_input');

                otpInputs.forEach((input, index) => {
                    // Auto-focus ke kotak seterusnya bila taip
                    input.addEventListener('input', (e) => {
                        if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                        updateFullToken();
                    });

                    // Backspace untuk balik ke kotak sebelumnya
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && !e.target.value && index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    });
                });

                function updateFullToken() {
                    let combinedValue = "";
                    otpInputs.forEach(input => {
                        combinedValue += input.value;
                    });
                    fullTokenInput.value = combinedValue;
                }

                document.getElementById('otp_form').addEventListener('submit', function(e) {
                    updateFullToken();
                });
            });
        </script>
    </body>
</html>