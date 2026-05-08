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

                            <div class="text-center mb-10">
                                <div class="d-flex flex-center mx-auto mb-7" style="width: 100px; height: 100px; background-color: #f1faff; border-radius: 50%;">
                                    <i class="bi bi-inbox-fill text-primary" style="font-size: 3.5rem;"></i>
                                </div>
                            </div>

                            <div class="text-center mb-10">
                                <?php if (session('error')) : ?>
                                    <h1 class="text-danger mb-3" style="font-size: 2.5rem; text-align: center;">Incorrect Code</h1>
                                    <div class="text-danger fw-semibold fs-5 mb-5" style="text-align: center;">
                                        <?= session('error') ?>. Sila semak emel dan cuba lagi.
                                    </div>
                                <?php else : ?>
                                    <h1 class="text-gray-900 mb-3" style="font-size: 2.5rem; text-align: center;">Sahkan Emel Anda</h1>
                                    <div class="text-muted fw-semibold fs-5 mb-5" style="text-align: center;">Masukkan kod pengesahan yang dihantar ke</div>
                                <?php endif; ?>

                                <div class="fw-bold text-primary fs-3 text-center">
                                <?php 
                                    $userEmail = '';
                                    if (isset($user)) {
                                        $userEmail = is_object($user) ? ($user->email ?? '') : ($user['email'] ?? '');
                                    } 
                                    
                                    if (empty($userEmail) && session()->has('user')) {
                                        $userSession = session('user');
                                        $userEmail = is_array($userSession) ? ($userSession['email'] ?? '') : '';
                                    }

                                    echo esc((string)($userEmail ?: 'your registered email')); 
                                ?>
                                </div>
                            </div>

                            <div class="mb-10">
                                <div class="fw-bold text-center text-gray-900 fs-6 mb-5">Taipkan kod keselamatan 6 digit anda</div>
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
                                    <span class="indicator-label">Sahkan Akaun</span>
                                </button>
                            </div>
                        </form>

                        <div class="text-center fw-semibold fs-5 mb-10">
                            <span class="text-muted me-1">Tidak menerima kod?</span>
                            <a href="<?= url_to('auth-action-show') ?>" class="link-primary fs-5">Hantar Semula Emel</a>
                        </div>

                        <div class="d-flex flex-center">
                            <img class="w-20px h-20px rounded me-2" src="<?= base_url('assets/media/flags/malaysia.svg') ?>" alt="MY" />
                            <span class="text-gray-700 fs-base">Bahasa Melayu</span>
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
                    // Auto-tab ke kotak seterusnya
                    input.addEventListener('input', (e) => {
                        if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                        updateFullToken();
                    });

                    // Backspace tab balik ke kotak sebelum
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