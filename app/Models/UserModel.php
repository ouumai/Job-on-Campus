<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        // Panggil fungsi asal Shield dulu
        parent::initialize();

        // Tambah fields custom kau supaya sistem benarkan data ni disimpan
        $this->allowedFields = array_merge($this->allowedFields, [
            'first_name',
            'last_name',
            'identity_no',
            'user_category',
        ]);
    }
}