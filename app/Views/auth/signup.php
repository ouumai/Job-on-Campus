<?php
    $metronic = $metronic ?? base_url('assets/');
    $asset = $asset ?? $metronic;
    $sessionLang = session()->get('lang');
    $currentLang = is_string($sessionLang) ? $sessionLang : 'ms';
?>
<!DOCTYPE html>
<html lang="eng">
	<head>
		<title>JoC System | Create an Account</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/media/logos/JoCLogo-favicon.png?v=3') ?>" />
		<link rel="shortcut icon" href="<?= base_url('assets/media/logos/JoCLogo-favicon.png?v=3') ?>" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="<?= $metronic ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= $metronic ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { themeMode = localStorage.getItem("data-bs-theme") || defaultThemeMode; } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

		<div class="d-flex flex-column flex-root">
			<style>
            /* 1. RESET GLOBAL & BACKGROUND */
            html, body, #kt_body { 
                background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow-x: hidden;
                filter: none !important;
            }

            /* Buang overlay gelap Metronic */
            .flex-root, .flex-column-fluid, .auth-bg {
                background: transparent !important;
            }

            body::before, #kt_body::before, body::after, #kt_body::after,
            .flex-root::before, .flex-root::after { 
                display: none !important; 
                content: none !important;
            }

            /* 2. PANEL / SHELL STYLING */
            .signup-shell { 
                max-width: 580px !important; /* Saiz yang lebih kompak[cite: 4] */
                position: relative; 
                z-index: 10; 
                box-shadow: 0 10px 40px rgba(0,0,0,0.06) !important; 
                border: none !important;
                border-radius: 1.25rem !important;
                overflow: hidden;
            }

            /* 3. HEADER / HERO SECTION */
            .signup-hero { 
                padding-top: 1rem !important; 
                padding-bottom: 2.5rem !important; 
                background: var(--bs-body-bg); 
                border-radius: 1.25rem 1.25rem 0 0 !important; 
            }

            /* 4. FORM SPACING */
            /* Pastikan margin-top ni 0 atau positif, jangan pakai negatif */
            .signup-form {
                margin-top: 0 !important; 
            }

            /* Kalau nak tajuk tu rapat lagi dengan subtitle */
            .signup-hero h1 { 
                font-size: 2.5rem !important; 
                margin-top: 0 !important; /* Pastikan tiada margin atas pada text tajuk */
                margin-bottom: 0.1rem !important; 
            }

            /* 4. FORM SPACING (KONSISTENSI Jarak) */
            /* Kita paksa reset margin pada row dan fv-row supaya mb-5 kat HTML berfungsi penuh[cite: 4] */
            .signup-form .fv-row, 
            .signup-form .row { 
                margin-bottom: 1.5rem !important; 
            }

            .signup-form .row .fv-row {
                margin-bottom: 0 !important;
            }

            /* 5. INPUT BOX STYLING */
            .signup-input { 
                height: 55px !important; 
                /* Tambah border halus macam skrin login */
                border: 1px solid var(--bs-gray-300) !important; 
                box-shadow: none !important; 
                background-color: transparent !important; /* Buat telus macam login page */
                border-radius: 0.75rem !important; /* Bulatkan sikit bucu dia */
                padding-left: 1.25rem !important;
            }

            /* Tambah kesan bila user klik (focus) pada kotak tu */
            .signup-input:focus {
                border-color: var(--bs-primary) !important;
                background-color: #fff !important;
            }

			/* Styling khusus untuk Select2 supaya sama tinggi dengan input box */
			.select2-container--bootstrap5 .select2-selection--single {
				height: 55px !important;
				border: 1px solid var(--bs-gray-300) !important;
				background-color: transparent !important;
				display: flex;
				align-items: center;
				border-radius: 0.75rem !important;
			}

			/* Pastikan teks dalam Select2 sejajar dengan input box lain */
			.select2-container--bootstrap5 .select2-selection--single .select2-selection__rendered {
				padding-left: 1.25rem !important; /* Sama dengan padding-left input kau */
				line-height: 55px !important;    /* Bagi dia duduk tengah-tengah secara vertical */
				color: var(--bs-gray-700) !important;
			}

			/* Hilangkan arrow default yang mungkin kacau alignment */
			.select2-container--bootstrap5 .select2-selection__arrow {
				height: 55px !important;
				top: 0 !important;
			}

            /* 6. GLASSMORPHISM (Pane Kiri)[cite: 4] */
            .auth-left-pane { background: transparent !important; }

            .auth-left-glass { 
                width: min(600px, 100%); 
                padding: 2.25rem; 
                border: 1px solid rgba(255, 255, 255, .35); 
                border-radius: 1.25rem; 
                background: rgba(255, 255, 255, .18); 
                box-shadow: none !important;
                backdrop-filter: blur(14px); 
                -webkit-backdrop-filter: blur(14px); 
            }

            .auth-left-glass .auth-left-title, 
            .auth-left-glass .auth-left-text { 
                color: #fff !important; 
                text-shadow: 0 1px 18px rgba(0, 26, 76, .25); 
            }

            /* 7. FOOTER & SOCIAL BUTTONS[cite: 4] */
            .mb-20 { 
                margin-bottom: 1.5rem !important; 
            }

            .signup-social-icon { 
                width: 38px; 
                height: 38px; 
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>

			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-lg-row-fluid">
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 auth-left-pane">
						<div class="auth-left-glass text-center">
						<img class="mx-auto mw-100 w-150px w-lg-300px mb-5 mb-lg-10" src="<?= $metronic ?>media/auth/JobSearch.png" alt="" />
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-3 auth-left-title">Job on Campus</h1>
						<div class="text-gray-600 fs-base text-center fw-semibold auth-left-text"><?= $currentLang === 'ms' ? 'Menyokong Kerjaya Pelajar Dalam Komuniti Universiti.' : 'Supporting Student Careers Within the University Community.' ?></div>
						</div>
					</div>
				</div>

				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<div class="bg-body d-flex flex-column rounded-4 w-100 w-md-600px signup-shell">
						<div class="signup-hero px-10 pt-10 pb-8">
							<div class="d-flex align-items-center justify-content-between mb-12">
								<a href="<?= base_url('login') ?>" class="btn btn-icon btn-light rounded-circle signup-back d-flex justify-content-center align-items-center" aria-label="Back">
									<span class="svg-icon svg-icon-2 text-gray-900" style="transform: translateX(-1px);">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M11.25 4.5L6.75 9L11.25 13.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M7.25 9H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</span>
								</a>
								<div class="fw-semibold fs-6">
									<span class="text-gray-400" data-kt-translate="sign-up-head-desc"><?= $currentLang === 'ms' ? 'Sudah menjadi ahli?' : 'Already a member?' ?></span>
									<a href="<?= base_url('login') ?>" class="link-primary ms-2" data-kt-translate="sign-up-head-link"><?= $currentLang === 'ms' ? 'Log Masuk' : 'Login' ?></a>
								</div>
							</div>
							<div class="pt-8">
								<h1 class="text-gray-900 fw-bolder fs-3x mb-3" data-kt-translate="sign-up-title"><?= $currentLang === 'ms' ? 'Buat Akaun' : 'Create an Account' ?></h1>
								<div class="text-gray-400 fw-semibold fs-6" data-kt-translate="sign-up-desc"><?= $currentLang === 'ms' ? 'Dapatkan akses tanpa had & hasilkan wang' : 'Get unlimited access & earn money' ?></div>
							</div>
						</div>

						<div class="px-10 pb-10">
							<div class="signup-form mx-auto">
								<form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST" action="<?= base_url('signup') ?>" onsubmit="sessionStorage.setItem('joctab_active', '1');">
                                    <input type="hidden" name="signup_lang" value="<?= esc($currentLang) ?>" />
									<div class="row gx-5 mb-5">
										<div class="col-6 fv-row">
											<input type="text" name="first_name" autocomplete="off" class="form-control form-control-lg bg-light signup-input signup-name-input" data-kt-translate="sign-up-input-first-name" />
										</div>
										<div class="col-6 fv-row">
											<input type="text" name="last_name" autocomplete="off" class="form-control form-control-lg bg-light signup-input signup-name-input" data-kt-translate="sign-up-input-last-name" />
										</div>
									</div>

									<div class="fv-row mb-5">
										<input type="text" name="identity_no" data-kt-translate="sign-up-input-identity" placeholder="<?= $currentLang === 'ms' ? 'No. Matrik atau UKMPer' : 'Matric No. or UKMPer' ?>" class="form-control form-control-lg bg-light signup-input" />
									</div>

									<div class="fv-row mb-5 position-relative">
										<!-- Custom Dropdown matching language switcher -->
										<button id="category_dropdown_btn" type="button" class="form-control form-control-lg bg-light signup-input d-flex justify-content-between align-items-center w-100 rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
											<span id="category_display" data-kt-translate="sign-up-input-category" class="text-gray-500 text-start">Select Category</span>
											<span class="svg-icon svg-icon-5 text-muted m-0 rotate-180" aria-hidden="true">
												<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</span>
										</button>
										<div id="category_dropdown_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 fs-5" data-kt-menu="true">
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-5 category-select-option" data-value="pelajar" data-translate-key="sign-up-option-student">
													<span data-kt-translate="sign-up-option-student">Student (Matric No.)</span>
												</a>
											</div>
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-5 category-select-option" data-value="kakitangan" data-translate-key="sign-up-option-staff">
													<span data-kt-translate="sign-up-option-staff">Staff (UKMPer)</span>
												</a>
											</div>
										</div>
										<input type="hidden" name="user_category" id="user_category_input" />
									
										<script>
											document.addEventListener('DOMContentLoaded', function() {
												var categoryInput = document.getElementById('user_category_input');
												var categoryText = document.getElementById('category_display');
												var options = document.querySelectorAll('.category-select-option');
												var categoryBtn = document.getElementById('category_dropdown_btn');
												var categoryMenu = document.getElementById('category_dropdown_menu');

												// Match dropdown width to button width
												categoryBtn.addEventListener('click', function() {
													categoryMenu.style.width = categoryBtn.offsetWidth + 'px';
												});

												options.forEach(function(option) {
													option.addEventListener('click', function(e) {
														e.preventDefault();
														var val = this.getAttribute('data-value');
														var translateKey = this.getAttribute('data-translate-key');
														var spanText = this.querySelector('span').innerText;
														
														categoryInput.value = val;
														
														categoryText.innerText = spanText;
														categoryText.setAttribute('data-kt-translate', translateKey);
														categoryText.classList.remove('text-gray-500');
														categoryText.classList.add('text-gray-900');

														// Highlight selected option
														options.forEach(function(opt) {
															opt.classList.remove('active');
														});
														this.classList.add('active');
													});
												});
											});
										</script>
									</div>

									<div class="fv-row mb-5">
										<input type="text" name="email" autocomplete="off" class="form-control form-control-lg bg-light signup-input" data-kt-translate="sign-up-input-email" />
									</div>

									<div class="fv-row mb-5" data-kt-password-meter="true">
										<div class="mb-1">
											<div class="position-relative mb-3">
												<input class="form-control form-control-lg bg-light signup-input" type="password" name="password" autocomplete="off" data-kt-translate="sign-up-input-password" />
												<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
													<i class="ki-duotone ki-eye-slash fs-2"></i>
													<i class="ki-duotone ki-eye fs-2 d-none"></i>
												</span>
											</div>
											<div class="d-flex align-items-center mb-5" data-kt-password-meter-control="highlight">
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
											</div>
										</div>
										<div class="text-muted" data-kt-translate="sign-up-hint">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
									</div>

									<div class="fv-row mb-5">
										<input name="confirm_password" type="password" autocomplete="off" class="form-control form-control-lg bg-light signup-input" placeholder="<?= $currentLang === 'ms' ? 'Sahkan Kata Laluan' : 'Confirm Password' ?>" data-kt-translate="sign-up-input-confirm-password" />
									</div>

									<input class="d-none" type="checkbox" name="toc" value="1" checked />

									<div class="d-flex align-items-center justify-content-between mb-20">
										<button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
											<span class="indicator-label" data-kt-translate="sign-up-submit">Submit</span>
											<span class="indicator-progress"><span data-kt-translate="general-progress">Please wait...</span>
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
										<div class="d-flex align-items-center gap-2 fw-semibold text-gray-500">
											<span data-kt-translate="general-or">Or</span>
											<a href="#" class="btn btn-icon btn-light bg-transparent signup-social-icon" aria-label="Google">
												<img alt="Google" src="<?= $metronic ?>media/svg/brand-logos/google-icon.svg" class="h-20px" />
											</a>
											<a href="#" class="btn btn-icon btn-light bg-transparent signup-social-icon" aria-label="Apple">
												<img alt="Apple" src="<?= $metronic ?>media/svg/brand-logos/apple-black.svg" class="theme-light-show h-20px" />
												<img alt="Apple" src="<?= $metronic ?>media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-20px" />
											</a>
										</div>
									</div>
									<?= csrf_field() ?>
								</form>

								<div class="d-flex flex-stack">
									<div class="me-10">
										<button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
											<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="<?= $metronic ?>media/flags/united-states.svg" alt="" />
											<span data-kt-element="current-lang-name" class="me-1">English</span>
											<span class="svg-icon svg-icon-5 text-muted rotate-180 m-0 signup-lang-chevron" aria-hidden="true">
												<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</span>
										</button>
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
											<div class="menu-item px-3">
												<a href="<?= base_url('lang?lang=en') ?>" class="menu-link d-flex px-5" data-kt-lang="en">
													<span class="symbol symbol-20px me-4">
														<img data-kt-element="lang-flag" class="rounded-1" src="<?= $metronic ?>media/flags/united-states.svg" alt="" />
													</span>
													<span data-kt-element="lang-name">English</span>
												</a>
											</div>
											<div class="menu-item px-3">
												<a href="<?= base_url('lang?lang=ms') ?>" class="menu-link d-flex px-5" data-kt-lang="ms">
													<span class="symbol symbol-20px me-4">
														<img data-kt-element="lang-flag" class="rounded-1" src="<?= $metronic ?>media/flags/malaysia.svg" alt="" />
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
				</div>
			</div>
		</div>

		<script>var hostUrl = "<?= $metronic ?>";</script>
		<script src="<?= $metronic ?>plugins/global/plugins.bundle.js"></script>
		<script src="<?= $metronic ?>js/scripts.bundle.js"></script>
		<script src="<?= $metronic ?>js/custom/authentication/sign-up/general.js"></script>
		<script src="<?= $metronic ?>js/custom/authentication/sign-in/i18n.js"></script>
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


