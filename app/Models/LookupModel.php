<?php

namespace App\Models;

use CodeIgniter\Model;

class LookupModel extends Model
{
    protected $table      = ''; 
    protected $primaryKey = 'id';
    protected $returnType = 'object'; 

    private $tableMap = [
        'status_iklan'     => 'pjoc101kstsiklan',
        'status_calon'     => 'pjoc102kstscalon',
        'status_timesheet' => 'pjoc103kststimesheet',
        'status_tuntutan'  => 'pjoc104kststuntutan',
        'import_batch'     => 'pjoc105kstsbatchimport',
        'import_row'       => 'pjoc106kstsrowimport',
        'jenis_peruntukan' => 'pjoc107kjnsperuntukan',
        'mod_kerja'        => 'pjoc108kmodkerja',
        'respon_tawaran'   => 'pjoc109krespontawaran',
        'sumber_calon'     => 'pjoc110ksumbercalon',
    ];

    // Ambil semua pilihan untuk dropdown
     
    public function getOptions($type)
    {
        if (!isset($this->tableMap[$type])) return [];
        
        return $this->db->table($this->tableMap[$type])
                        ->where('is_active', 1)
                        ->orderBy('sort_order', 'ASC')
                        ->get()
                        ->getResult();
    }

    // Ambil label teks (BM/EN) mengikut kod
     
    public function getLabel($type, $code)
    {
        if (!isset($this->tableMap[$type])) return $code;

        $row = $this->db->table($this->tableMap[$type])
                        ->where('kod', $code)
                        ->get()
                        ->getRow();

        if (!$row) return $code;

        // Check bahasa semasa sistem
        $lang = service('request')->getLocale();
        return ($lang == 'en') ? $row->label_en : $row->label;
    }

    // Ambil warna badge Bootstrap (cth: success, danger)

    public function getBadge($type, $code)
    {
        if (!isset($this->tableMap[$type])) return 'secondary';

        $row = $this->db->table($this->tableMap[$type])
                        ->where('kod', $code)
                        ->get()
                        ->getRow();

        return $row ? $row->badge_color : 'secondary';
    }
}