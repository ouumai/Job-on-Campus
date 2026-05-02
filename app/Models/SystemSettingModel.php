<?php

namespace App\Models;

use CodeIgniter\Model;

class SystemSettingModel extends Model
{
    protected $table            = 'pjoc001msettings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['key', 'value'];

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

    /**
     * Ambil nilai tetapan berdasarkan kunci (key)
     * Contoh: getSetting('kadar_jam_default', '6.50')
     */
    public function getSetting($key, $default = null)
    {
        $result = $this->where('key', $key)->first();
        
        return $result ? $result->value : $default;
    }

    // Kemaskini atau cipta tetapan baru
    public function setSetting($key, $value)
    {
        $existing = $this->where('key', $key)->first();

        if ($existing) {
            return $this->update($existing->id, ['value' => $value]);
        }

        return $this->insert([
            'key'   => $key,
            'value' => $value
        ]);
    }

}
