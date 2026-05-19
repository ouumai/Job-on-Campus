<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Profil Saya<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Profil Saya<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?>Profil Saya<?= $this->endSection() ?>

<?= $this->section('extra-css') ?>
<style>
    /* Glassmorphism Content Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.45) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4) !important;
        box-shadow: 0 20px 50px rgba(0,0,0,0.06) !important;
        border-radius: 1.5rem !important;
    }

    /* Kemasan Gaya Kotak Input di dalam Glass Card */
    .glass-input {
        background: rgba(255, 255, 255, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        color: #181c32 !important;
        font-weight: 500 !important;
    }

    .glass-input:focus {
        background: rgba(255, 255, 255, 0.8) !important;
        border-color: #0052D4 !important;
        box-shadow: 0 0 10px rgba(0, 82, 212, 0.15) !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
    $fullName = $fullName !== '' ? $fullName : ($user->username ?? 'Pengguna');
    $firstName = trim((string) ($user->first_name ?? ''));
    $lastName = trim((string) ($user->last_name ?? ''));
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
    if ($initials === '') {
        $initials = strtoupper(substr((string) ($user->username ?? 'U'), 0, 2));
    }
    $avatar = trim((string) ($user->profile_image ?? ''));
    $avatarUrl = $avatar !== '' ? base_url($avatar) : null;
?>

<div class="card glass-card max-w-900px mx-auto animate__animated animate__fadeIn">
    <div class="card-body p-10">
        
        <?php if (session('message')): ?>
            <div class="alert alert-success bg-white bg-opacity-50 border-success d-flex align-items-center p-4 mb-6">
                <i class="ki-duotone ki-check-circle fs-2 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                <div class="fw-semibold text-gray-800"><?= esc(session('message')) ?></div>
            </div>
        <?php endif; ?>
        
        <?php if (session('error')): ?>
            <div class="alert alert-danger bg-white bg-opacity-50 border-danger d-flex align-items-center p-4 mb-6">
                <i class="ki-duotone ki-information-2 fs-2 text-danger me-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="fw-semibold text-gray-800"><?= esc(session('error')) ?></div>
            </div>
        <?php endif; ?>
        
        <?php if (session('errors')): ?>
            <div class="alert alert-danger bg-white bg-opacity-50 border-danger d-flex align-items-center p-4 mb-6">
                <i class="ki-duotone ki-information-2 fs-2 text-danger me-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="fw-semibold text-gray-800">
                    <?= implode('<br>', array_map('esc', session('errors'))) ?>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('profil') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-8 text-start">
                
                <div class="col-lg-4 d-flex flex-column align-items-center text-center border-end border-gray-300 border-opacity-40 pe-lg-8">
                    <label class="form-label fw-bold text-gray-800 fs-6 mb-4">Gambar Profil Semasa</label>
                    
                    <div class="mb-4">
                        <?php if ($avatarUrl): ?>
                            <img src="<?= esc($avatarUrl) ?>" alt="Avatar" class="w-180px h-180px rounded object-fit-cover border border-4 border-white shadow-sm" />
                        <?php else: ?>
                            <div class="w-180px h-180px rounded border border-4 border-white shadow-sm d-flex align-items-center justify-content-center bg-primary text-white fs-1 fw-bolder">
                                <?= esc($initials) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="w-100">
                        <input type="file" name="profile_image" class="form-control glass-input fs-7" accept=".jpg,.jpeg,.png,.webp">
                        <div class="text-muted fs-8 mt-2">Format yang dibenarkan: **JPG, PNG, WEBP** (Maksimum 2MB).</div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h3 class="fw-bolder text-gray-900 mb-6 fs-4 d-flex align-items-center">
                        <i class="ki-duotone ki-profile-user fs-2 text-primary me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        Maklumat Identiti Pengguna
                    </h3>
                    
                    <div class="row g-5">
                        <div class="col-md-6">
                            <label class="form-label required fw-bold text-gray-700 fs-7">Nama Depan</label>
                            <input type="text" name="first_name" class="form-control glass-input" value="<?= esc(old('first_name', $user->first_name ?? '')) ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label required fw-bold text-gray-700 fs-7">Nama Belakang</label>
                            <input type="text" name="last_name" class="form-control glass-input" value="<?= esc(old('last_name', $user->last_name ?? '')) ?>" required>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label required fw-bold text-gray-700 fs-7">Alamat Emel Rasmi</label>
                            <input type="email" name="email" class="form-control glass-input" value="<?= esc(old('email', $user->email ?? '')) ?>" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-muted fs-7">Peranan Sistem / Kumpulan Akaun</label>
                            <div class="bg-white bg-opacity-30 p-3 rounded-3 border border-white border-opacity-60 text-gray-700 fw-semibold fs-7 d-flex align-items-center">
                                <span class="bullet bullet-dot bg-success h-8px w-8px me-2"></span>
                                Log Masuk Sebagai Akaun: 
                                <span class="text-primary fw-bolder ms-1 text-uppercase">
                                    <?php 
                                        if ($user->inGroup('student')) echo 'Pelajar';
                                        elseif ($user->inGroup('supervisor')) echo 'Penyelia';
                                        elseif ($user->inGroup('career')) echo 'Urusetia';
                                        else echo 'Pengguna';
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed border-gray-400 my-8"></div>

            <div class="text-start">
                <h3 class="fw-bolder text-gray-900 mb-2 fs-4 d-flex align-items-center">
                    <i class="ki-duotone ki-key fs-2 text-warning me-2"><span class="path1"></span><span class="path2"></span></i>
                    Tukar Kata Laluan Keselamatan
                </h3>
                <p class="text-muted fs-7 mb-6">Isi bahagian di bawah sekiranya anda berniat untuk menukar kod kelayakan akses semasa anda sahaja.</p>
                
                <div class="row g-5">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-gray-700 fs-7">Kata Laluan Semasa</label>
                        <input type="password" name="current_password" class="form-control glass-input" value="" autocomplete="current-password">
                    </div>
                    <div class="col-md-4" data-kt-password-meter="true">
                        <label class="form-label fw-bold text-gray-700 fs-7">Kata Laluan Baharu</label>
                        <div class="position-relative mb-3">
                            <input type="password" name="new_password" class="form-control glass-input" value="" autocomplete="new-password">
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="ki-duotone ki-eye-slash fs-2"></i>
                                <i class="ki-duotone ki-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <div class="text-muted fs-7">
                            Minimum 8 aksara, gabungan huruf besar, huruf kecil, nombor, dan simbol.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-gray-700 fs-7">Sahkan Kata Laluan Baharu</label>
                        <input type="password" name="confirm_password" class="form-control glass-input" value="" autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed border-gray-400 my-8"></div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="submit" class="btn btn-primary fw-bold px-8 shadow-sm">
                    <i class="ki-duotone ki-cloud-change fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
        
    </div>
</div>
<?= $this->endSection() ?>
