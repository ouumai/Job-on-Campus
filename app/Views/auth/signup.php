<?php
    $metronic = $metronic ?? base_url('assets/');
    $asset = $asset ?? $metronic;
?>
<!DOCTYPE html>
<html lang="eng">
	<head>
		<title>Create an Account</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="<?= $metronic ?>media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="<?= $metronic ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= $metronic ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { themeMode = localStorage.getItem("data-bs-theme") || defaultThemeMode; } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

		<div class="d-flex flex-column flex-root">
			<style>
                body { background-image: url('<?= $asset ?>media/auth/bg10.jpeg'); }
                [data-bs-theme="dark"] body { background-image: url('<?= $asset ?>media/auth/bg10-dark.jpeg'); }
                .signup-shell { max-width: 620px; overflow: hidden; }
                .signup-hero { background: var(--bs-body-bg); }
                .signup-back { width: 44px; height: 44px; }
                .signup-form { max-width: 450px; }
                .signup-input { height: 82px; border: 0; box-shadow: none; }
                .signup-input:focus { box-shadow: none; }
                .signup-name-input { border-radius: .625rem .625rem 0 0; }
                .signup-social-icon { width: 34px; height: 34px; }
                .signup-lang-chevron { color: currentColor; }
            </style>

			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-lg-row-fluid">
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?= $metronic ?>media/auth/agency.png" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?= $metronic ?>media/auth/agency-dark.png" alt="" />
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
						<div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post,
						<a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they have interviewed
						<br />and provides some background information about
						<a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
						<br />work following this is a transcript of the interview.</div>
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
									<div class="row g-5 mb-8">
										<div class="col-6 fv-row">
											<input type="text" name="first-name" value="Umairah" autocomplete="off" class="form-control form-control-lg bg-light signup-input signup-name-input" data-kt-translate="sign-up-input-first-name" />
										</div>
										<div class="col-6 fv-row">
											<input type="text" name="last-name" value="Sabri" autocomplete="off" class="form-control form-control-lg bg-light signup-input signup-name-input" data-kt-translate="sign-up-input-last-name" />
										</div>
									</div>

									<div class="fv-row mb-8">
										<input type="text" name="email" value="n.umairahsabri@gmail.com" autocomplete="off" class="form-control form-control-lg bg-light signup-input" data-kt-translate="sign-up-input-email" />
									</div>

									<div class="fv-row mb-8" data-kt-password-meter="true">
										<div class="mb-1">
											<div class="position-relative mb-3">
												<input class="form-control form-control-lg bg-light signup-input" type="password" value="password123" name="password" autocomplete="off" data-kt-translate="sign-up-input-password" />
												<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
													<i class="ki-duotone ki-eye-slash fs-2"></i>
													<i class="ki-duotone ki-eye fs-2 d-none"></i>
												</span>
											</div>
											<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
												<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
											</div>
										</div>
										<div class="text-muted" data-kt-translate="sign-up-hint">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
									</div>

									<div class="fv-row mb-8">
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
											<a href="#" class="btn btn-icon btn-light bg-transparent signup-social-icon" aria-label="Facebook">
												<img alt="Facebook" src="<?= $metronic ?>media/svg/brand-logos/facebook-3.svg" class="h-20px" />
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
