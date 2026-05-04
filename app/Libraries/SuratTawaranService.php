<?php

namespace App\Libraries;

use App\Models\SuratTawaranModel;
use App\Models\CalonKerjaModel;
use Dompdf\Dompdf;

class SuratTawaranService
{
    protected $suratModel;
    protected $calonModel;

    public function __construct()
    {
        $this->suratModel = new SuratTawaranModel();
        $this->calonModel = new CalonKerjaModel();
    }

    // Jana PDF dan keluarkan surat tawaran

    public function generateAndIssue($candidateId)
    {
        // 1. Dapatkan data calon dan iklan berkaitan
        $candidate = $this->calonModel->select('pjoc003mmohonkerja.*, pjoc002miklanpekerjaan.tajuk, pjoc002miklanpekerjaan.kadar_jam')
                                      ->join('pjoc002miklanpekerjaan', 'pjoc002miklanpekerjaan.id = pjoc003mmohonkerja.id_kerja')
                                      ->find($candidateId);

        if (!$candidate) return false;

        // 2. Setup Dompdf
        $dompdf = new Dompdf();
        $html = view('emails/surat_tawaran_template', ['data' => $candidate]); // Kita akan buat view ni nanti
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // 3. Simpan fail PDF ke folder writable
        $filename = 'offer_' . $candidate->matrik . '_' . time() . '.pdf';
        $filepath = WRITEPATH . 'uploads/offers/' . $filename;
        file_put_contents($filepath, $dompdf->output());

        // 4. Rekod dalam jadual surat tawaran dan kemaskini status calon
        $this->suratModel->insert([
            'matrik' => $candidate->matrik,
            'letter_file' => $filename,
            'respon_pelajar' => 'pending'
        ]);

        return $this->calonModel->update($candidateId, ['status' => 'offer_issued']);
    }
}