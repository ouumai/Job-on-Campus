<?php

namespace App\Controllers;

class Language extends BaseController
{
    public function index()
    {
        // 1. Ambil kod bahasa dari URL (contoh: lang?lang=ms)
        $lang = strtolower((string) $this->request->getGet('lang'));

        // 2. Senarai bahasa yang JoC support
        $supportedLangs = ['en', 'ms'];

        if (in_array($lang, $supportedLangs, true)) {
            // 3. SIMPAN DALAM SESSION - Ini paling penting untuk emel nanti
            session()->set('lang', $lang);
            
            // 4. Tukar bahasa untuk request semasa
            service('language')->setLocale($lang);
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'ok',
                'lang'   => session()->get('lang') ?? 'en',
            ]);
        }

        // 5. Pergi balik ke page asal
        return redirect()->back();
    }
}
