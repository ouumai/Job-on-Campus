<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Selamat Datang, <?= $currentUser->username ?? 'User' ?>!</h3>
        </div>
        <div class="card-body">
            <p>Tahniah Mai! Layout Metronic v8.3.3 kau dah berjaya diintegrasikan dengan CodeIgniter 4.7.0.</p>
            <div class="alert alert-primary">
                Sistem JoC kini sedia untuk pembangunan modul seterusnya.
            </div>
        </div>
    </div>
<?= $this->endSection() ?>