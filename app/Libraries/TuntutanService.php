<?php

namespace App\Libraries;

use App\Models\TuntutanModel;
use App\Models\TimesheetModel;

class TuntutanService
{
    protected $tuntutanModel;
    protected $timesheetModel;

    public function __construct()
    {
        $this->tuntutanModel = new TuntutanModel();
        $this->timesheetModel = new TimesheetModel();
    }

    // Pelajar hantar tuntutan bulanan
    public function submitClaim($matrik, $bulan, $kadarJam)
    {
        // 1. Ambil jumlah jam yang telah di-verify untuk bulan tersebut
        $totalHours = $this->timesheetModel->selectSum('jumlah_jam')
                                           ->where(['matrik' => $matrik, 'status' => 'verified'])
                                           ->where("FORMAT(minggu_bermula, 'yyyy-MM') =", $bulan)
                                           ->first();

        $hours = $totalHours->jumlah_jam ?? 0;

        // 2. Kira jumlah bayaran secara automatik
        $amount = $hours * $kadarJam;

        // 3. Simpan rekod tuntutan
        return $this->tuntutanModel->insert([
            'matrik' => $matrik,
            'bulan' => $bulan,
            'jumlah_jam' => $hours,
            'jumlah_bayaran' => $amount,
            'status' => 'pending_supervisor' // Mula dengan kelulusan penyelia
        ]);
    }
}