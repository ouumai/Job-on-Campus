<?php

namespace App\Libraries;

use App\Models\IklanKerjaModel;
use App\Models\NotifikasiModel;

class JobAdService
{
    protected $iklanModel;
    protected $notifikasiModel;

    public function __construct()
    {
        $this->iklanModel = new IklanKerjaModel();
        $this->notifikasiModel = new NotifikasiModel();
    }

    // Hantar iklan untuk kelulusan mengikut jenis peruntukan

    public function submitForApproval($id)
    {
        $iklan = $this->iklanModel->find($id);
        if (!$iklan) return false;

        $newStatus = 'draft';

        // Tentukan aliran status berdasarkan jenis peruntukan
        switch ($iklan->jenis_peruntukan) {
            case 'ptj':
                $newStatus = 'pending_kp'; // Pergi ke Ketua Pentadbiran PTJ
                break;
            case 'projek_tabung':
                $newStatus = 'pending_ketua_projek'; // Pergi ke Ketua Projek
                break;
            case 'career_dept':
                $newStatus = 'pending_career'; // Terus ke Urusetia Kerjaya
                break;
        }

        return $this->iklanModel->update($id, ['status' => $newStatus]);
    }

    // Urusetia meluluskan iklan (pending_career -> active)

    public function approveCareer($id)
    {
        return $this->iklanModel->update($id, ['status' => 'active']);
    }

    // Tutup iklan dan tamatkan semua calon aktif secara automatik
    public function close($id)
    {
        // 1. Tukar status iklan ke closed
        $this->iklanModel->update($id, ['status' => 'closed']);

        // 2. Automatik tamatkan semua calon (Logik ini akan panggil CalonService nanti)
        // TODO: Panggil CalonService::terminateAllByJob($id)
        
        return true;
    }
}