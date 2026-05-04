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
        }
    };

    var translate = function (lang) {
        Object.keys(translationStrings).forEach(function (label) {
            var translatedText = translationStrings[label][lang];
            var labelElement = document.querySelector('[data-kt-translate="' + label + '"]');

            if (!translatedText || labelElement === null) {
                return;
            }

            if (labelElement.tagName === "INPUT") {
                labelElement.setAttribute("placeholder", translatedText);
            } else {
                labelElement.textContent = translatedText;
            }
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
