<?php
    $metronic = $metronic ?? base_url('assets/');
    $asset = $asset ?? $metronic;
	$currentLang = session()->get('lang') ?? 'ms';
	$currentLangName = $currentLang === 'ms' ? 'Bahasa Melayu' : 'English';
	$currentLangFlag = $currentLang === 'ms' ? 'malaysia.svg' : 'united-states.svg';
?>
<!DOCTYPE html>
<html lang="eng">
	<!--begin::Head-->
	<head>
		<title>JoC System | Login</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="http://preview.keenthemes.com/authentication/layouts/overlay/sign-in.html" />
		<link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/media/logos/JoCLogo-favicon.png?v=3') ?>" />
		<link rel="shortcut icon" href="<?= base_url('assets/media/logos/JoCLogo-favicon.png?v=3') ?>" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?= $metronic ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?= $metronic ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page bg image-->
			<style>
				/* Target terus body atau id kt_body untuk gradient yang bersih */
				body, #kt_body { 
					background: linear-gradient(135deg, #87CEEB 0%, #B0C4DE 50%, #ADD8E6 100%) !important;
					min-height: 100vh !important;
					margin: 0;
					/* Pastikan tiada filter atau overlay */
					filter: none !important;
				}

				/* Paksa hilangkan sebarang lapisan overlay gelap dari Metronic */
				body::before, #kt_body::before, 
				body::after, #kt_body::after { 
					display: none !important; 
					content: none !important;
				}

				.auth-panel { 
					/* Samakan dengan signup-shell (600px atau 620px ikut citarasa kau) */
					max-width: 600px !important; 
					position: relative; 
					z-index: 10; 
					/* Guna shadow yang nipis macam kita buat kat signup tadi */
					box-shadow: 0 10px 40px rgba(0,0,0,0.06) !important; 
					border-radius: 1.25rem !important;
				}

				/* Kekalkan styling lain */
				.flex-root { position: relative; z-index: 1; }
				.auth-left-pane { position: relative; overflow: hidden; }
				.auth-left-glass { 
					width: min(600px, 100%); 
					padding: 2.25rem; 
					border: 1px solid rgba(255, 255, 255, .35); 
					border-radius: 1.25rem; 
					background: rgba(255, 255, 255, .18); 
					box-shadow: 0 24px 70px rgba(0, 32, 96, .24); 
					backdrop-filter: blur(14px); 
					-webkit-backdrop-filter: blur(14px); 
				}

				/* Guna styling ni supaya 'Or with email' duduk dalam satu baris dengan garis */
				.separator.separator-content {
					display: flex;
					align-items: center;
					text-align: center;
					width: 100%;
				}

				.separator.separator-content::before,
				.separator.separator-content::after {
					content: "";
					flex: 1;
					border-bottom: 1px solid var(--bs-gray-300); /* Garis nipis */
				}

				.separator.separator-content::before {
					margin-right: 1rem; /* Jarak antara garis kiri dengan teks */
				}

				.separator.separator-content::after {
					margin-left: 1rem; /* Jarak antara garis kanan dengan teks */
				}

				.auth-separator-label {
					white-space: nowrap; /* Paksa teks duduk dalam satu baris sahaja */
					padding: 0 !important;
				}

			</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 auth-left-pane">
						<div class="auth-left-glass text-center">
						<!--begin::Image-->
						<img class="mx-auto mw-100 w-150px w-lg-300px mb-5 mb-lg-10" src="<?= $metronic ?>media/auth/JobSearch.png" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-3 auth-left-title">Job on Campus</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="text-gray-600 fs-base text-center fw-semibold auth-left-text"><?= $currentLang === 'ms' ? 'Menyokong Kerjaya Pelajar Dalam Komuniti Universiti.' : 'Supporting Student Careers Within the University Community.' ?></div>
						<!--end::Text-->
						</div>
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<!--begin::Wrapper-->
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-100 w-md-600px p-10 auth-panel">
						<!--begin::Content-->
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-100 w-md-450px auth-form-wrap">
							<!--begin::Wrapper-->
							<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
								<!--begin::Form-->
								<form class="form w-100" id="kt_sign_in_form" method="POST" action="<?= base_url('login') ?>" onsubmit="sessionStorage.setItem('joctab_active', '1');">
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

									<!--begin::Heading-->
									<div class="text-center mb-11">
										<!--begin::Title-->
										<h1 class="text-gray-900 fw-bolder mb-3" data-kt-translate="sign-in-title"><?= $currentLang === 'ms' ? 'Log Masuk' : 'Login' ?></h1>
										<!--end::Title-->
										<!--begin::Subtitle-->
										<div class="text-gray-500 fw-semibold fs-6" data-kt-translate="sign-in-desc"><?= $currentLang === 'ms' ? 'Kempen Sosial Anda' : 'Your Social Campaigns' ?></div>
										<!--end::Subtitle=-->
									</div>
									<!--begin::Heading-->
									<!--begin::Login options-->
									<div class="row g-3 mb-9">
										<!--begin::Col-->
										<div class="col-md-6">
											<!--begin::Google link=-->
											<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
											<img alt="Logo" src="<?= $metronic ?>media/svg/brand-logos/google-icon.svg" class="h-15px me-3" /><span class="auth-social-label" data-kt-translate="sign-in-google"> <?= $currentLang === 'ms' ? 'Log masuk dengan Google' : 'Login with Google' ?></span></a>
											<!--end::Google link=-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-md-6">
											<!--begin::Google link=-->
											<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
											<img alt="Logo" src="<?= $metronic ?>media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
											<img alt="Logo" src="<?= $metronic ?>media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" /><span class="auth-social-label" data-kt-translate="sign-in-apple"><?= $currentLang === 'ms' ? 'Log masuk dengan Apple' : 'Login with Apple' ?></span></a>
											<!--end::Google link=-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Login options-->
									<!--begin::Separator-->
									<div class="separator separator-content my-14">
										<span class="auth-separator-label text-gray-500 fw-semibold fs-7" data-kt-translate="general-or-email"><?= $currentLang === 'ms' ? 'Atau dengan emel' : 'Or with email' ?></span>
									</div>
									<!--end::Separator-->
									<!--begin::Input group=-->
									<div class="fv-row mb-8">
										<!--begin::Email-->
										<input type="text" placeholder="<?= $currentLang === 'ms' ? 'Emel' : 'Email' ?>" name="email" autocomplete="off" class="form-control bg-transparent" data-kt-translate="sign-in-input-email" />
										<!--end::Email-->
									</div>
									<!--end::Input group=-->
									<div class="fv-row mb-3">
										<!--begin::Password-->
										<input type="password" placeholder="<?= $currentLang === 'ms' ? 'Kata Laluan' : 'Password' ?>" name="password" autocomplete="off" class="form-control bg-transparent" data-kt-translate="sign-in-input-password" />
										<!--end::Password-->
									</div>
									<!--end::Input group=-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
										<div></div>
										<!--begin::Link-->
										<a href="<?= base_url('forgot-password') ?>" class="link-primary" data-kt-translate="sign-in-forgot-password"><?= $currentLang === 'ms' ? 'Lupa Kata Laluan?' : 'Forgot Password?' ?></a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Submit button-->
									<div class="d-grid mb-10">
										<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
											<!--begin::Indicator label-->
											<span class="indicator-label" data-kt-translate="sign-in-submit"><?= $currentLang === 'ms' ? 'Log Masuk' : 'Login' ?></span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress"><span data-kt-translate="general-progress"><?= $currentLang === 'ms' ? 'Sila tunggu...' : 'Please wait...' ?></span>
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											<!--end::Indicator progress-->
										</button>
									</div>
									<!--end::Submit button-->
									<!--begin::Sign up-->
									<div class="text-gray-500 text-center fw-semibold fs-6">
										<span data-kt-translate="sign-in-head-desc"><?= $currentLang === 'ms' ? 'Belum menjadi ahli?' : 'Not a Member yet?' ?></span>
										<a href="<?= base_url('signup') ?>" class="link-primary" data-kt-translate="sign-in-head-link"><?= $currentLang === 'ms' ? 'Daftar' : 'Sign up' ?></a>
									</div>
									<!--end::Sign up-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Footer-->
							<div class="d-flex flex-stack">
								<!--begin::Languages-->
								<div class="me-10">
									<!--begin::Toggle-->
									<button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
										<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="<?= $metronic ?>media/flags/<?= esc($currentLangFlag) ?>" alt="" />
										<span data-kt-element="current-lang-name" class="me-1"><?= esc($currentLangName) ?></span>
										<span class="svg-icon svg-icon-5 text-muted rotate-180 m-0" aria-hidden="true">
											<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</span>
									</button>
									<!--end::Toggle-->
									<!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
										<!-- English -->
										<div class="menu-item px-3">
											<a href="<?= base_url('lang?lang=en') ?>" class="menu-link d-flex px-5" data-kt-lang="en">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= $metronic ?>media/flags/united-states.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">English</span>
											</a>
										</div>

										<!-- Malaysia (ms) -->
										<div class="menu-item px-3">
											<a href="<?= base_url('lang?lang=ms') ?>" class="menu-link d-flex px-5" data-kt-lang="ms">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= $metronic ?>media/flags/malaysia.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">Bahasa Melayu</span>
											</a>
										</div>
									</div>
									<!--end::Menu-->
								</div>
								<!--end::Languages-->
								<!--begin::Links-->
								<div class="d-flex fw-semibold text-primary fs-base gap-5 auth-footer-links">
									<a href="pages/team.html" target="_blank" data-kt-translate="footer-terms">Terms</a>
									<a href="pages/pricing/column.html" target="_blank" data-kt-translate="footer-plans">Plans</a>
									<a href="pages/contact.html" target="_blank" data-kt-translate="footer-contact">Contact Us</a>
								</div>
								<!--end::Links-->
							</div>
							<!--end::Footer-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "<?= $metronic ?>";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= $metronic ?>plugins/global/plugins.bundle.js"></script>
		<script src="<?= $metronic ?>js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<!-- <script src="<?= $metronic ?>js/custom/authentication/sign-in/general.js"></script> -->
		<script src="<?= $metronic ?>js/custom/authentication/sign-in/i18n.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
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
	<!--end::Body-->
</html>


