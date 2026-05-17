<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Selamat datang kembali, <?= esc($currentUser->username ?? 'Pengguna') ?>!</h3>
        </div>
        <div class="card-body">
            <p>Integrasi Metronic v8.3.3 dengan CodeIgniter 4.7.0 telah berjaya disiapkan.</p>
            <div class="alert alert-primary">
                Sistem JoC kini berada pada fasa sedia untuk pembangunan modul-modul seterusnya.
            </div>
        </div>
    </div>
<?= $this->endSection() ?>