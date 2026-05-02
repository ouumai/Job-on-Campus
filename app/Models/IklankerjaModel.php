<?php

namespace App\Models;

use CodeIgniter\Model;

class IklankerjaModel extends Model
{
    protected $table            = 'pjoc002miklanpekerjaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kod_ptj', 'ukmper_penyelia', 'ukmper_ketua_projek', 'tajuk', 
        'description', 'tkh_mula', 'tkh_tamat', 'tkh_tutup_calon', 
        'kemahiran', 'kekosongan', 'jenis_peruntukan', 'mod_kerja', 
        'kadar_jam', 'perlu_temuduga', 'tkh_temuduga_default', 
        'masa_temuduga_default', 'lokasi_temuduga_default', 'status', 
        'sebab_penolakan', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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

    // Ambil iklan yang aktif sahaja untuk paparan pelajar
    public function getActiveAds()
    {
        return $this->where('status', 'active')
                    ->where('tkh_tutup_calon >=', date('Y-m-d'))
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Cari iklan milik penyelia tertentu
    public function getBySupervisor($ukmper)
    {
        return $this->where('ukmper_penyelia', $ukmper)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Kira berapa kekosongan yang dah diisi
     * (Akan join dengan CalonKerjaModel nanti)
     */
    public function countFilledVacancies($jobId)
    {
        return $this->db->table('pjoc003mmohonkerja')
                        ->where('id_kerja', $jobId)
                        ->whereIn('status', ['recommended', 'offer_issued', 'active'])
                        ->countAllResults();
    }

}
