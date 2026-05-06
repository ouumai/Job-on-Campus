<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'first_name'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'last_name'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'identity_no'   => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'user_category' => ['type' => 'ENUM', 'constraint' => ['pelajar', 'kakitangan'], 'default' => 'pelajar'],
        ];
        $this->forge->addColumn('users', $fields); // Tambah ke table users sedia ada
    }

    public function down()
    {
        //
    }
}
