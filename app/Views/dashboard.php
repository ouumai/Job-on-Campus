<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    Halaman Utama
<?= $this->endSection() ?>

<?= $this->section('extra-css') ?>
<style>
    /* Glassmorphism Content Card */
    .welcome-card {
        background: rgba(255, 255, 255, 0.45) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 50px rgba(0,0,0,0.06) !important;
        border-radius: 1.5rem !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card welcome-card">
    <div class="card-body p-10">

        <?php 
            $user = auth()->user();
            $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            if (empty($fullName)) {
                $fullName = $user->username ?? 'Pengguna';
            }
        ?>
        <h1 class="fw-bolder text-gray-900 mb-6 fs-1 text-start mt-4">
            Selamat Datang, <?= esc($fullName) ?>!
        </h1>
        
        <div class="separator separator-dashed border-gray-300 my-6"></div>

        <div class="text-gray-800 fs-4 mb-8 text-start" style="line-height: 1.8; text-align: justify !important;">
            <?php if ($user->inGroup('student')): ?>
                Dalam sistem ini, sebagai <span class="badge badge-light-info fw-bold fs-5 px-3 py-2 text-capitalize">Pelajar</span>, anda boleh:
                <ul class="list-unstyled mt-4 ms-6">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Menerokai tawaran jawatan kosong yang aktif di dalam kampus.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Memantau status permohonan secara masa nyata.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Menerima dan menyemak surat tawaran pelantikan digital.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Merekodkan log jam bekerja harian melalui <i class="ms-1">Borang Timesheet</i>.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Menguruskan tuntutan elaun bulanan anda dengan mudah.
                    </li>
                </ul>
                
            <?php elseif ($user->inGroup('supervisor')): ?>
                Dalam sistem ini, sebagai <span class="badge badge-light-info fw-bold fs-5 px-3 py-2 text-capitalize">Penyelia PTJ</span>, anda boleh:
                <ul class="list-unstyled mt-4 ms-6">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Mengurus dan mengiklankan kekosongan jawatan di bawah jabatan anda.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Memproses pengambilan calon (termasuk fungsi import data pemohon melalui Excel).
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Menyemak peruntukan dana tabung berkaitan jawatan.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Melakukan pengesahan tugasan dan kehadiran mingguan pelajar sebelum dihantar untuk proses pembayaran.
                    </li>
                </ul>
                
            <?php elseif ($user->inGroup('career')): ?>
                Dalam sistem ini, sebagai <span class="badge badge-light-info fw-bold fs-5 px-3 py-2 text-capitalize">Urusetia (Unit Kerjaya)</span>, anda boleh:
                <ul class="list-unstyled mt-4 ms-6">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Memantau keseluruhan aktiviti pengiklanan di dalam sistem.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Menjalankan semakan audit ke atas profil pemohon.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Menguruskan agihan peruntukan bajet tahunan universiti.
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        Memberikan kelulusan akhir ke atas pemprosesan bayaran elaun bulanan (<i class="ms-1">Payroll</i>) pelajar.
                    </li>
                </ul>
            <?php endif; ?>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>