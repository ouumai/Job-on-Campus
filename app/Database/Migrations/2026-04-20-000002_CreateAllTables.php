<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAllTables extends Migration
{
    public function up()
    {
        // ── pjoc001msettings ────────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('key');
        $this->forge->createTable('pjoc001msettings', true);

        $this->db->table('pjoc001msettings')->insertBatch([
            ['key' => 'kadar_jam_default',           'value' => '6.50', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'max_jam_tahun',               'value' => '320',  'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'max_jam_minggu_semester',     'value' => '40',   'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'max_jam_minggu_luar_semester', 'value' => '20',  'created_at' => date('Y-m-d H:i:s')],
        ]);

        // ── pjoc011murusetia ────────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ukmper' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => false,
                'comment'    => 'Staff ID from SSO (session id)',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'tahap_akses' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 1,
                'comment'    => '1=Pegawai, 2=Penyelia Urusetia, 3=Pentadbir',
            ],
            'aktif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 1,
                'comment'    => '1=Aktif, 0=Tidak Aktif',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('ukmper');
        $this->forge->createTable('pjoc011murusetia', true);

        // ── pjoc002miklanpekerjaan ──────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kod_ptj' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'ukmper_penyelia' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => false,
            ],
            'ukmper_ketua_projek' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'kodgl' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'tajuk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tkh_mula' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tkh_tamat' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tkh_tutup_calon' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'perlu_temuduga' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'tkh_temuduga_default' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'masa_temuduga_default' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'lokasi_temuduga_default' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'kemahiran' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'kekosongan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 1,
            ],
            'jenis_peruntukan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'ptj',
            ],
            'mod_kerja' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'timesheet',
            ],
            'kadar_jam' => [
                'type'       => 'DECIMAL',
                'constraint' => '8,2',
                'null'       => false,
                'default'    => 6.50,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'draft',
            ],
            'sebab_penolakan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pjoc002miklanpekerjaan', true);

        // ── pjoc003mmohonkerja ──────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kerja' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'matrik' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => false,
            ],
            'source' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'import_batch_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'pending',
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tkh_temuduga' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'masa_temuduga' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'lokasi_temuduga' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'tkh_tamat_kerja' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'sebab_tamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ditamatkan_oleh' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['id_kerja', 'matrik'], 'uq_job_student');
        $this->forge->addForeignKey('id_kerja', 'pjoc002miklanpekerjaan', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pjoc003mmohonkerja', true);

        // ── pjoc004msurattawaran ────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_calon' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'letter_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'respon_pelajar' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'pending',
            ],
            'tarikh_respon' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_calon', 'pjoc003mmohonkerja', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pjoc004msurattawaran', true);

        // ── pjoc005mtimesheets ──────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_calon' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'minggu_bermula' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'minggu_berakhir' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'jumlah_jam' => [
                'type'       => 'DECIMAL',
                'constraint' => '6,2',
                'null'       => false,
                'default'    => 0,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'pending',
            ],
            'id_sah' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'tkh_sah' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_calon', 'pjoc003mmohonkerja', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pjoc005mtimesheets', true);

        // ── pjoc006mtuntutan ────────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_calon' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => false,
                'comment'    => 'Format YYYY-MM',
            ],
            'jumlah_jam' => [
                'type'       => 'DECIMAL',
                'constraint' => '8,2',
                'null'       => false,
                'default'    => 0,
            ],
            'jumlah_bayaran' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
                'default'    => 0,
            ],
            'fail_bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'pautan_bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'pending_supervisor',
            ],
            'sebab_penolakan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_calon', 'pjoc003mmohonkerja', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pjoc006mtuntutan', true);

        // ── pjoc007mperuntukanbajetcareer ───────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tahun' => [
                'type' => 'YEAR',
                'null' => false,
            ],
            'jumlah_diperuntukkan' => [
                'type'       => 'DECIMAL',
                'constraint' => '14,2',
                'null'       => false,
                'default'    => 0,
            ],
            'jumlah_dibelanjakan' => [
                'type'       => 'DECIMAL',
                'constraint' => '14,2',
                'null'       => false,
                'default'    => 0,
            ],
            'baki' => [
                'type'       => 'DECIMAL',
                'constraint' => '14,2',
                'null'       => false,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('tahun');
        $this->forge->createTable('pjoc007mperuntukanbajetcareer', true);

        // ── pjoc008mbatchimportpelajar ──────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kerja' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'jumlah_rows' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
            'jumlah_berjaya' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
            'jumlah_gagal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_kerja', 'pjoc002miklanpekerjaan', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pjoc008mbatchimportpelajar', true);

        // ── pjoc009mstudentimport ───────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'batch_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'row_number' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'row_data' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'matrik' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'pending',
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('batch_id', 'pjoc008mbatchimportpelajar', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pjoc009mstudentimport', true);

        // ── pjoc010mnotifications ───────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'matrik' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => false,
            ],
            'tajuk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'mesej' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'pautan' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'telah_dibaca' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
            'deleted_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('matrik');
        $this->forge->createTable('pjoc010mnotifications', true);
    }

    public function down()
    {
        // Drop in reverse order (FK dependencies)
        $this->forge->dropTable('pjoc010mnotifications', true);
        $this->forge->dropTable('pjoc009mstudentimport', true);
        $this->forge->dropTable('pjoc008mbatchimportpelajar', true);
        $this->forge->dropTable('pjoc007mperuntukanbajetcareer', true);
        $this->forge->dropTable('pjoc006mtuntutan', true);
        $this->forge->dropTable('pjoc005mtimesheets', true);
        $this->forge->dropTable('pjoc004msurattawaran', true);
        $this->forge->dropTable('pjoc003mmohonkerja', true);
        $this->forge->dropTable('pjoc002miklanpekerjaan', true);
        $this->forge->dropTable('pjoc011murusetia', true);
        $this->forge->dropTable('pjoc001msettings', true);
    }
}
