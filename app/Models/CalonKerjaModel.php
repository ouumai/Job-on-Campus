<?php

namespace App\Models;

use CodeIgniter\Model;

class CalonKerjaModel extends Model
{
    protected $table            = 'pjoc003mmohonkerja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kerja', 'matrik', 'source', 'import_batch_id', 
        'status', 'remarks', 'tkh_temuduga', 'masa_temuduga', 
        'lokasi_temuduga', 'tkh_tamat_kerja', 'sebab_tamat', 'ditamatkan_oleh'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Cari semua permohonan untuk satu iklan

    public function getByJob($jobId)
    {
        return $this->where('id_kerja', $jobId)->findAll();
    }

    /**
     * Semak jika pelajar sudah ada kerja yang aktif
     * Syarat: Satu pelajar, satu kerja aktif sahaja.
     */
    public function hasActiveJob($matrik)
    {
        return $this->where('matrik', $matrik)
                    ->where('status', 'active')
                    ->first() !== null;
    }

    // Semak jika pelajar sudah memohon iklan yang sama
    public function hasApplied($jobId, $matrik)
    {
        return $this->where('id_kerja', $jobId)
                    ->where('matrik', $matrik)
                    ->first() !== null;
    }

}
