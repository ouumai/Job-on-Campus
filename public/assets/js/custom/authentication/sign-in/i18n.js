"use strict";

var KTAuthI18nDemo = function () {
    var menu;

    var translationStrings = {
        
        "sign-in-title": {
            eng: "Sign In",
            ms: "Log Masuk"
        },
        "sign-in-desc": {
            eng: "Your Social Campaigns",
            ms: "Kempen Sosial Anda"
        },
        "sign-in-google": {
            eng: "Sign in with Google",
            ms: "Log Masuk Google"
        },
        "sign-in-apple": {
            eng: "Sign in with Apple",
            ms: "Log Masuk Apple"
        },
        "general-or-email": {
            eng: "Or with email",
            ms: "Atau dengan emel"
        },
        "general-or": {
            eng: "Or",
            ms: "Atau"
        },
        "general-progress": {
            eng: "Please wait...",
            ms: "Sila tunggu..."
        },
        "sign-in-input-email": {
            eng: "Email",
            ms: "Emel"
        },
        "sign-in-input-password": {
            eng: "Password",
            ms: "Kata Laluan"
        },
        "sign-in-forgot-password": {
            eng: "Forgot Password ?",
            ms: "Lupa Kata Laluan ?"
        },
        "sign-in-submit": {
            eng: "Sign In",
            ms: "Log Masuk"
        },
        "sign-in-head-desc": {
            eng: "Not a Member yet?",
            ms: "Belum menjadi ahli?"
        },
        "sign-in-head-link": {
            eng: "Sign up",
            ms: "Daftar"
        },
        "sign-up-head-desc": {
            eng: "Already a member ?",
            ms: "Sudah menjadi ahli?"
        },
        "sign-up-head-link": {
            eng: "Sign In",
            ms: "Log Masuk"
        },
        "sign-up-title": {
            eng: "Create an Account",
            ms: "Cipta Akaun"
        },
        "sign-up-desc": {
            eng: "Get unlimited access & earn money",
            ms: "Dapatkan akses tanpa had & jana pendapatan"
        },
        "sign-up-input-first-name": {
            eng: "First Name",
            ms: "Nama Pertama"
        },
        "sign-up-input-last-name": {
            eng: "Last Name",
            ms: "Nama Akhir"
        },
        "sign-up-input-email": {
            eng: "Email",
            ms: "Emel"
        },
        "sign-up-input-password": {
            eng: "Password",
            ms: "Kata Laluan"
        },
        "sign-up-input-confirm-password": {
            eng: "Confirm Password",
            ms: "Sahkan Kata Laluan"
        },
        "sign-up-hint": {
            eng: "Use 8 or more characters with a mix of letters, numbers & symbols.",
            ms: "Guna 8 aksara atau lebih dengan gabungan huruf, nombor & simbol."
        },
        "sign-up-submit": {
            eng: "Submit",
            ms: "Hantar"
        },

        "sign-up-input-category": {
            eng: "Select Category",
            ms: "Pilih Kategori"
        },

        "sign-up-option-student": {
            eng: "Student",
            ms: "Pelajar"
        },

        "sign-up-option-staff": {
            eng: "Staff",
            ms: "Kakitangan"
        },

        "sign-up-input-identity": {
            eng: "Matric No. or UKMPer",
            ms: "No. Matrik atau UKMPer"
        },

        "footer-terms": {
            eng: "Terms",
            ms: "Terma"
        },
        "footer-plans": {
            eng: "Plans",
            ms: "Pelan"
        },
        "footer-contact": {
            eng: "Contact Us",
            ms: "Hubungi Kami"
        },

        // OTP / Two-Step Verification
        "two-step-title": {
            eng: "Verify Your Email",
            ms: "Sahkan Emel Anda"
        },
        "two-step-desc": {
            eng: "Enter the verification code we sent to",
            ms: "Masukkan kod pengesahan yang dihantar ke"
        },
        "two-step-input-label": {
            eng: "Type your 6 digit security code",
            ms: "Taipkan kod keselamatan 6 digit anda"
        },
        "two-step-submit": {
            eng: "Verify Account",
            ms: "Sahkan Akaun"
        },
        "two-step-resend-text": {
            eng: "Didn’t get the code?",
            ms: "Tidak menerima kod?"
        },
        "two-step-resend-link": {
            eng: "Resend Email",
            ms: "Hantar Semula Emel"
        }
    };

    var translate = function (lang) {
        Object.keys(translationStrings).forEach(function (label) {
            var translatedText = translationStrings[label][lang];
            var labelElements = document.querySelectorAll('[data-kt-translate="' + label + '"]');

            if (!translatedText || labelElements.length === 0) {
                return;
            }

            labelElements.forEach(function(labelElement) {
                if (labelElement.tagName === "INPUT") {
                    labelElement.setAttribute("placeholder", translatedText);
                } else {
                    labelElement.textContent = translatedText;
                }
            });
        });

        $('[data-control="select2"]').select2({
            minimumResultsForSearch: Infinity // Ini pun boleh tolong sorok search box
        });
    };

    var setLanguage = function (lang) {
        var selectedLang = menu.querySelector('[data-kt-lang="' + lang + '"]');

        if (selectedLang === null) {
            return;
        }

        var currentLangName = document.querySelector('[data-kt-element="current-lang-name"]');
        var currentLangFlag = document.querySelector('[data-kt-element="current-lang-flag"]');
        var selectedLangName = selectedLang.querySelector('[data-kt-element="lang-name"]');
        var selectedLangFlag = selectedLang.querySelector('[data-kt-element="lang-flag"]');

        if (currentLangName && selectedLangName) {
            currentLangName.textContent = selectedLangName.textContent;
        }

        if (currentLangFlag && selectedLangFlag) {
            currentLangFlag.setAttribute("src", selectedLangFlag.getAttribute("src"));
        }

        menu.querySelectorAll("[data-kt-lang]").forEach(function (item) {
            item.classList.toggle("active", item.getAttribute("data-kt-lang") === lang);
        });

        document.documentElement.setAttribute("lang", lang);
        localStorage.setItem("kt_auth_lang", lang);
    };

    var init = function () {
        var lang = localStorage.getItem("kt_auth_lang") || "eng";

        if (!translationStrings["sign-in-title"][lang]) {
            lang = "eng";
        }

        setLanguage(lang);
        translate(lang);

        menu.querySelectorAll("[data-kt-lang]").forEach(function (item) {
            item.addEventListener("click", function (event) {
                event.preventDefault();

                var selectedLang = item.getAttribute("data-kt-lang");
                setLanguage(selectedLang);
                translate(selectedLang);
            });
        });
    };

    return {
        init: function () {
            menu = document.querySelector("#kt_auth_lang_menu");

            if (menu === null) {
                return;
            }

            init();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAuthI18nDemo.init();
});
