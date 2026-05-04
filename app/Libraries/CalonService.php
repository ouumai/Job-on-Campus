<?php

namespace App\Libraries;

use App\Models\CalonKerjaModel;
use App\Models\IklanKerjaModel;

class CalonService
{
    protected $calonModel;
    protected $iklanModel;

    public function __construct()
    {
        $this->calonModel = new CalonKerjaModel();
        $this->iklanModel = new IklanKerjaModel();
    }

    // Pelajar memohon kerja

    public function studentApply($jobId, $matrik)
    {
        // 1. Semak jika pelajar sudah ada kerja aktif (Syarat: 1 pelajar = 1 kerja aktif)
        if ($this->calonModel->hasActiveJob($matrik)) {
            return ['status' => false, 'message' => 'Anda sudah mempunyai kerja aktif.'];
        }

        $iklan = $this->iklanModel->find($jobId);

        // 2. Set data permohonan
        $data = [
            'id_kerja' => $jobId,
            'matrik'   => $matrik,
            'source'   => 'pelajar_mohon',
            'status'   => ($iklan->perlu_temuduga == 1) ? 'interview' : 'pending' // Auto-set status
        ];

        // 3. Jika perlu temuduga, ambil nilai default dari iklan
        if ($iklan->perlu_temuduga == 1) {
            $data['tkh_temuduga'] = $iklan->tkh_temuduga_default;
            $data['masa_temuduga'] = $iklan->masa_temuduga_default;
            $data['lokasi_temuduga'] = $iklan->lokasi_temuduga_default;
        }

        $this->calonModel->insert($data);
        return ['status' => true, 'message' => 'Permohonan berjaya dihantar.'];
    }
}