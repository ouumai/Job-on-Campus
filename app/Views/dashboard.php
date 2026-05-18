<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    Halaman Utama
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow-sm border-0 bg-white bg-opacity-75" style="backdrop-filter: blur(10px); border-radius: 1rem;">
    <div class="card-body p-10 text-center">
        <div class="mb-6">
            <i class="ki-duotone ki-home-user fs-5hx text-primary">
                <span class="path1"></span><span class="path2"></span>
            </i>
        </div>

        <h1 class="fw-bolder text-gray-900 mb-2">
            Selamat Datang, <?= auth()->user()->username ?? 'Pengguna' ?>!
        </h1>
        
        <p class="text-gray-700 fs-5 mb-8 mx-auto" style="max-width: 600px;">
            Anda telah berjaya log masuk ke dalam **Sistem Job on Campus (JoC) v1.6**. 
            Sila gunakan bar navigasi di bahagian atas untuk menguruskan rekod permohonan, log kerja, mahupun urusan kelulusan mengikut peranan akaun anda.
        </p>

        <div class="separator separator-dashed border-gray-300 my-6"></div>

        <div class="text-muted fs-7">
            Peranan Semasa: 
            <span class="badge badge-light-primary fw-bold text-capitalize px-3 py-1 fs-8">
                <?php 
                    if (auth()->user()->inGroup('student')) echo 'Pelajar';
                    elseif (auth()->user()->inGroup('supervisor')) echo 'Penyelia';
                    elseif (auth()->user()->inGroup('career')) echo 'Urusetia';
                ?>
            </span>
        </div>
    </div>
</div>
<?= $this->endSection() ?>