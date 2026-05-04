<?php

namespace App\Libraries;

use App\Models\PeruntukanBajetKarier;

class BajetService
{
    protected $bajetModel;

    public function __construct()
    {
        $this->bajetModel = new PeruntukanBajetKarier();
    }

    // Tolak bajet bila tuntutan career_dept diluluskan
    public function deduct($amount)
    {
        $currentYear = date('Y');
        $bajet = $this->bajetModel->where('tahun', $currentYear)->first();

        if ($bajet && $bajet->baki >= $amount) {
            $newBaki = $bajet->baki - $amount;
            $newSpent = $bajet->jumlah_dibelanjakan + $amount;

            return $this->bajetModel->update($bajet->id, [
                'baki' => $newBaki,
                'jumlah_dibelanjakan' => $newSpent
            ]);
        }
        return false;
    }
}