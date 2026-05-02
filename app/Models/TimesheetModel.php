<?php

namespace App\Models;

use CodeIgniter\Model;

class TimesheetModel extends Model
{
    protected $table            = 'pjoc005mtimesheets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'matrik', 'minggu_bermula', 'minggu_berakhir', 
        'jumlah_jam', 'remarks', 'status', 'id_sah', 'tkh_sah'
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

    // Cari timesheet milik pelajar tertentu
    public function getByStudent($matrik)
    {
        return $this->where('matrik', $matrik)
                    ->orderBy('minggu_bermula', 'DESC')
                    ->findAll();
    }

    /**
     * Kira jumlah jam bekerja pelajar untuk bulan tertentu
     * Penting untuk pengiraan tuntutan bulanan.
     */
    public function getTotalHoursForMonth($matrik, $month)
    {
        return $this->selectSum('jumlah_jam')
                    ->where('matrik', $matrik)
                    ->where("FORMAT(minggu_bermula, 'yyyy-MM') =", $month)
                    ->where('status', 'verified')
                    ->first();
    }

    // Cari timesheet yang menunggu pengesahan penyelia
    public function getPendingBySupervisor($ukmper)
    {
        // Logic ini akan join dengan iklan kerja untuk pastikan penyelia yang betul
        return $this->select('pjoc005mtimesheets.*')
                    ->join('pjoc002miklanpekerjaan', 'pjoc002miklanpekerjaan.id = pjoc005mtimesheets.id_kerja', 'left') // Note: id_kerja perlu ada dalam schema timesheet jika perlu rujukan terus
                    ->where('pjoc005mtimesheets.status', 'pending')
                    ->findAll();
    }

}
