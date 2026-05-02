<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratTawaranModel extends Model
{
    protected $table            = 'pjoc004msurattawaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'matrik', 'letter_file', 'respon_pelajar', 'tarikh_respon'
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

    // Cari surat tawaran untuk pelajar tertentu
    public function getByStudent($matrik)
    {
        return $this->where('matrik', $matrik)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    // Cari tawaran yang masih menunggu maklum balas pelajar
    public function getPending()
    {
        return $this->where('respon_pelajar', 'pending')
                    ->findAll();
    }

}
