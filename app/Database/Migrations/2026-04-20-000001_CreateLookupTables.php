<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLookupTables extends Migration
{
    /**
     * Table registry: type alias → table name.
     * Prefix: pjoc10{n}k{name}
     */
    private const TABLES = [
        // ksts — Status
        'status_iklan'        => 'pjoc101kstsiklan',
        'status_calon'        => 'pjoc102kstscalon',
        'status_timesheet'    => 'pjoc103kststimesheet',
        'status_tuntutan'     => 'pjoc104kststuntutan',
        'status_import_batch' => 'pjoc105kstsbatchimport',
        'status_import_row'   => 'pjoc106kstsrowimport',
        // kjns — Jenis
        'jenis_peruntukan'    => 'pjoc107kjnsperuntukan',
        // kmod — Mod
        'mod_kerja'           => 'pjoc108kmodkerja',
        // krespon — Respons
        'respon_tawaran'      => 'pjoc109krespontawaran',
        // ksumber — Sumber
        'sumber_calon'        => 'pjoc110ksumbercalon',
    ];

    public function up()
    {
        foreach (self::TABLES as $table) {
            $this->createLookupTable($table);
        }

        $now = date('Y-m-d H:i:s');

        // ── pjoc101kstsiklan ────────────────────────────────
        $this->db->table('pjoc101kstsiklan')->insertBatch([
            ['kod' => 'draft',                 'label_en' => 'Draft',                'label_ms' => 'Draf',               'badge' => 'secondary', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'pending_kp',            'label_en' => 'Pending KP',           'label_ms' => 'Menunggu KP',        'badge' => 'info',      'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'pending_ketua_projek',  'label_en' => 'Pending Project Head', 'label_ms' => 'Menunggu Ketua Projek', 'badge' => 'info',   'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'pending_career',        'label_en' => 'Pending Approval',     'label_ms' => 'Menunggu Kelulusan', 'badge' => 'warning',   'sort_order' => 4, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'active',                'label_en' => 'Active',               'label_ms' => 'Aktif',              'badge' => 'success',   'sort_order' => 5, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'rejected',              'label_en' => 'Rejected',             'label_ms' => 'Ditolak',            'badge' => 'danger',    'sort_order' => 6, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'closed',                'label_en' => 'Closed',               'label_ms' => 'Ditutup',            'badge' => 'dark',      'sort_order' => 7, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc102kstscalon ────────────────────────────────
        $this->db->table('pjoc102kstscalon')->insertBatch([
            ['kod' => 'pending',        'label_en' => 'Pending',              'label_ms' => 'Menunggu',            'badge' => 'warning',   'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'interview',      'label_en' => 'Called for Interview', 'label_ms' => 'Dipanggil Temuduga', 'badge' => 'info',      'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'recommended',    'label_en' => 'Recommended',          'label_ms' => 'Disyorkan',           'badge' => 'info',      'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'offer_issued',   'label_en' => 'Offer Issued',         'label_ms' => 'Tawaran Dikeluarkan', 'badge' => 'primary',   'sort_order' => 4, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'offer_declined', 'label_en' => 'Offer Declined',       'label_ms' => 'Tawaran Ditolak',     'badge' => 'danger',    'sort_order' => 5, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'active',         'label_en' => 'Active',               'label_ms' => 'Aktif',               'badge' => 'success',   'sort_order' => 6, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'ended',          'label_en' => 'Ended',                'label_ms' => 'Tamat',               'badge' => 'secondary', 'sort_order' => 7, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'rejected',       'label_en' => 'Rejected',             'label_ms' => 'Ditolak',             'badge' => 'danger',    'sort_order' => 8, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc103kststimesheet ────────────────────────────
        $this->db->table('pjoc103kststimesheet')->insertBatch([
            ['kod' => 'pending',  'label_en' => 'Pending',  'label_ms' => 'Menunggu',  'badge' => 'warning', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'verified', 'label_en' => 'Verified', 'label_ms' => 'Disahkan',  'badge' => 'success', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'rejected', 'label_en' => 'Rejected', 'label_ms' => 'Ditolak',   'badge' => 'danger',  'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc104kststuntutan ─────────────────────────────
        $this->db->table('pjoc104kststuntutan')->insertBatch([
            ['kod' => 'pending_supervisor', 'label_en' => 'Supervisor Review', 'label_ms' => 'Semakan Penyelia', 'badge' => 'warning', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'pending_career',     'label_en' => 'Career Review',     'label_ms' => 'Semakan Kerjaya',  'badge' => 'info',    'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'pending_kp',         'label_en' => 'KP Review',         'label_ms' => 'Semakan KP',       'badge' => 'info',    'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'approved',           'label_en' => 'Approved',          'label_ms' => 'Diluluskan',       'badge' => 'success', 'sort_order' => 4, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'rejected',           'label_en' => 'Rejected',          'label_ms' => 'Ditolak',          'badge' => 'danger',  'sort_order' => 5, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc105kstsbatchimport ──────────────────────────
        $this->db->table('pjoc105kstsbatchimport')->insertBatch([
            ['kod' => 'pending',    'label_en' => 'Pending',    'label_ms' => 'Menunggu',  'badge' => 'warning', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'processing', 'label_en' => 'Processing', 'label_ms' => 'Memproses', 'badge' => 'info',    'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'completed',  'label_en' => 'Completed',  'label_ms' => 'Selesai',   'badge' => 'success', 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'failed',     'label_en' => 'Failed',     'label_ms' => 'Gagal',     'badge' => 'danger',  'sort_order' => 4, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc106kstsrowimport ────────────────────────────
        $this->db->table('pjoc106kstsrowimport')->insertBatch([
            ['kod' => 'pending', 'label_en' => 'Pending', 'label_ms' => 'Menunggu', 'badge' => 'warning', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'success', 'label_en' => 'Success', 'label_ms' => 'Berjaya',  'badge' => 'success', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'failed',  'label_en' => 'Failed',  'label_ms' => 'Gagal',    'badge' => 'danger',  'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc107kjnsperuntukan ───────────────────────────
        $this->db->table('pjoc107kjnsperuntukan')->insertBatch([
            ['kod' => 'career_dept',    'label_en' => 'Career Division', 'label_ms' => 'Bahagian Kerjaya', 'badge' => null, 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'ptj',            'label_en' => 'Department',      'label_ms' => 'PTJ',              'badge' => null, 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'projek_tabung',  'label_en' => 'Project/Fund',   'label_ms' => 'Projek/Tabung',    'badge' => null, 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc108kmodkerja ────────────────────────────────
        $this->db->table('pjoc108kmodkerja')->insertBatch([
            ['kod' => 'timesheet',  'label_en' => 'Timesheet',  'label_ms' => 'Timesheet',     'badge' => null, 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'task_proof', 'label_en' => 'Task Proof', 'label_ms' => 'Bukti Tugasan', 'badge' => null, 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc109krespontawaran ───────────────────────────
        $this->db->table('pjoc109krespontawaran')->insertBatch([
            ['kod' => 'pending',  'label_en' => 'Pending Response', 'label_ms' => 'Menunggu Respons', 'badge' => 'warning', 'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'accepted', 'label_en' => 'Accepted',        'label_ms' => 'Diterima',         'badge' => 'success', 'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'declined', 'label_en' => 'Declined',        'label_ms' => 'Ditolak',          'badge' => 'danger',  'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
        ]);

        // ── pjoc110ksumbercalon ─────────────────────────────
        $this->db->table('pjoc110ksumbercalon')->insertBatch([
            ['kod' => 'pelajar_mohon',  'label_en' => 'Self-Applied',      'label_ms' => 'Permohonan Sendiri', 'badge' => 'info',      'sort_order' => 1, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'penyelia_keyin', 'label_en' => 'Supervisor Key-in', 'label_ms' => 'Key-in Penyelia',    'badge' => 'primary',   'sort_order' => 2, 'is_active' => 1, 'created_at' => $now],
            ['kod' => 'import_excel',   'label_en' => 'Excel Import',      'label_ms' => 'Import Excel',       'badge' => 'secondary', 'sort_order' => 3, 'is_active' => 1, 'created_at' => $now],
        ]);
    }

    public function down()
    {
        foreach (self::TABLES as $table) {
            $this->forge->dropTable($table, true);
        }
    }

    /**
     * Create a lookup table with the standard structure.
     */
    private function createLookupTable(string $name): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kod' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'label_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'label_ms' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'badge' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'sort_order' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kod');
        $this->forge->createTable($name, true);
    }
}
