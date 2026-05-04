<?php
    $metronic = $metronic ?? base_url('assets/');
    $asset = $asset ?? $metronic;
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
                /* 1. Paksa gradient cover 100% tanpa sebarang gangguan lapisan */
                html, body, #kt_body { 
                    background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
                    height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    overflow-x: hidden;
                    filter: none !important; /* Buang sebarang filter */
                }

                /* 2. KILL semua lapisan overlay gelap Metronic (Punca bayangan bawah tu) */
                .flex-root, .flex-column-fluid, .auth-bg {
                    background: transparent !important;
                }

                .flex-root::before, .flex-root::after,
                .flex-column-fluid::before, .flex-column-fluid::after,
                body::before, body::after,
                #kt_body::before, #kt_body::after { 
                    display: none !important; 
                    content: none !important;
                }

                /* 3. Nipiskan shadow panel supaya tak nampak kusam[cite: 2] */
                .signup-hero { 
                    background: var(--bs-body-bg); 
                    /* Tambah ni supaya bucu atas dia bulat ikut shell */
                    border-radius: 1.25rem 1.25rem 0 0 !important; 
                }

                .signup-shell { 
                    max-width: 620px; 
                    position: relative; 
                    z-index: 10; 
                    box-shadow: 0 10px 40px rgba(0,0,0,0.06) !important; 
                    border: none !important;
                    border-radius: 1.25rem !important; /* Pastikan shell pun ada radius */
                    overflow: hidden; /* Tambah ni untuk 'potong' apa-apa yang terkeluar */
                }

                /* 4. Pane kiri telus sepenuhnya[cite: 2] */
                .auth-left-pane { background: transparent !important; }

                .auth-left-glass { 
                    width: min(520px, 100%); 
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

                /* Styling tambahan untuk elemen signup[cite: 2] */
                /* 1. Kurangkan padding utama dalam shell */
                .signup-shell { 
                    max-width: 580px !important; /* Kecikkan sikit lebar dari 600px ke 580px */
                }

                /* 2. Kurangkan padding bahagian hero (Header) */
                .signup-hero { 
                    padding-top: 1.5rem !important; /* Dari pt-10 ke 1.5rem */
                    padding-bottom: 2.5rem !important; /* Dari pb-8 ke 0.5rem */
                }

                /* 3. Kurangkan margin bawah title dan input group */
                .signup-hero h1 { 
                    font-size: 2rem !important; /* Kecikkan sikit saiz font tajuk */
                    margin-bottom: 0.25rem !important; /* Rapatkan dengan subtitle */
                }

                /* Padam atau tukar semua ni supaya konsisten (contoh: 1.25rem) */
                .signup-form .fv-row { 
                    margin-bottom: 1.25rem !important; 
                }

                /* Buang selector spesifik yang kacau jarak tadi */
                .signup-form .row.mb-8, 
                .signup-form .fv-row.mb-8 { 
                    margin-bottom: 1.25rem !important; 
                }

                /* 4. Kecikkan padding container form */
                .px-10.pb-10 { 
                    padding-left: 2.5rem !important; 
                    padding-right: 2.5rem !important;
                    padding-bottom: 2rem !important; /* Kurangkan dari pb-10 */
                }

                /* 5. Jarak butang submit dengan social icons */
                .mb-20 { 
                    margin-bottom: 1.5rem !important; /* Kurangkan dari mb-20[cite: 2] */
                }
            </style>

			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-lg-row-fluid">
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 auth-left-pane">
						<div class="auth-left-glass text-center">
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?= $metronic ?>media/auth/agency.png" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?= $metronic ?>media/auth/agency-dark.png" alt="" />
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7 auth-left-title">Fast, Efficient and Productive</h1>
						<div class="text-gray-600 fs-base text-center fw-semibold auth-left-text">In this kind of post,
						<a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they have interviewed
						<br />and provides some background information about
						<a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
						<br />work following this is a transcript of the interview.</div>
						</div>
					</div>
				</div>

				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<div class="bg-body d-flex flex-column rounded-4 w-100 w-md-600px signup-shell">
						<div class="signup-hero px-10 pt-10 pb-8">
							<div class="d-flex align-items-center justify-content-between mb-12">
								<a href="<?= base_url('login') ?>" class="btn btn-icon btn-light rounded-circle signup-back" aria-label="Back">
									<span class="svg-icon svg-icon-2 text-gray-900">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M11.25 4.5L6.75 9L11.25 13.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M7.25 9H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</span>
								</a>
								<div class="fw-semibold fs-6">
									<span class="text-gray-400" data-kt-translate="sign-up-head-desc">Already a member ?</span>
									<a href="<?= base_url('login') ?>" class="link-primary ms-2" data-kt-translate="sign-up-head-link">Sign In</a>
								</div>
							</div>
							<div class="pt-8">
								<h1 class="text-gray-900 fw-bolder fs-3x mb-3" data-kt-translate="sign-up-title">Create an Account</h1>
								<div class="text-gray-400 fw-semibold fs-6" data-kt-translate="sign-up-desc">Get unlimited access & earn money</div>
							</div>
						</div>

						<div class="px-10 pb-10">
							<div class="signup-form mx-auto">
								<form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="<?= base_url('login') ?>" action="#">
									<div class="row g-5 mb-1">
										<div class="col-6 fv-row">
											<input type="text" name="first-name" autocomplete="off" class="form-control form-control-lg bg-light signup-input signup-name-input" data-kt-translate="sign-up-input-first-name" />
										</div>
										<div class="col-6 fv-row">
											<input type="text" name="last-name" autocomplete="off" class="form-control form-control-lg bg-light signup-input signup-name-input" data-kt-translate="sign-up-input-last-name" />
										</div>
									</div>

									<div class="fv-row mb-10">
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
										<input name="confirm-password" type="password" autocomplete="off" class="form-control form-control-lg bg-light signup-input" placeholder="Confirm Password" data-kt-translate="sign-up-input-confirm-password" />
									</div>

									<input class="d-none" type="checkbox" name="toc" value="1" checked />

									<div class="d-flex align-items-center justify-content-between mb-20">
										<button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
											<span class="indicator-label" data-kt-translate="sign-up-submit">Submit</span>
											<span class="indicator-progress"><span data-kt-translate="general-progress">Please wait...</span>
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
										<div class="d-flex align-items-center gap-6 fw-semibold text-gray-500">
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
												<a href="#" class="menu-link d-flex px-5" data-kt-lang="eng">
													<span class="symbol symbol-20px me-4">
														<img data-kt-element="lang-flag" class="rounded-1" src="<?= $metronic ?>media/flags/united-states.svg" alt="" />
													</span>
													<span data-kt-element="lang-name">English</span>
												</a>
											</div>
											<div class="menu-item px-3">
												<a href="#" class="menu-link d-flex px-5" data-kt-lang="ms">
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
	</body>
</html>
