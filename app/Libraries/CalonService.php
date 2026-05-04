<?php namespace App\Libraries;

use App\Models\CalonKerjaModel;

class CalonService {
    protected $model;

    public function __construct() {
        $this->model = new CalonKerjaModel();
    }

    public function studentApply($jobId, $matrik) {
        // Logic: Check hasActiveJob() dulu sebelum simpan permohonan
    }

    public function processImportBatch($batchId) {
        // Logic: Guna PhpSpreadsheet untuk baca Excel dan masukkan calon
    }
}