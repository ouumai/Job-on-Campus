<?php

namespace App\Controllers;

class Language extends BaseController
{
    public function index()
    {
        // 1. Ambil kod bahasa dari URL (contoh: lang?lang=ms)
        $lang = $this->request->getGet('lang'); 

        // 2. Senarai bahasa yang JoC support
        $supportedLangs = ['en', 'ms'];

        if (in_array($lang, $supportedLangs)) {
            // 3. SIMPAN DALAM SESSION - Ini paling penting untuk emel nanti
            session()->set('lang', $lang);
            
            // 4. Tukar bahasa untuk request semasa
            service('language')->setLocale($lang);
        }

        // 5. Pergi balik ke page pendaftaran tadi
        return redirect()->back();
    }
}