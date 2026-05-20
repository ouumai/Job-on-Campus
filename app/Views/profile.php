<?= $this->extend('layouts/main') ?>

<?php $isMs = (session('lang') ?? 'ms') === 'ms'; ?>
<?= $this->section('title') ?><?= $isMs ? 'Profil Saya' : 'My Profile' ?><?= $this->endSection() ?>
<?= $this->section('page-title') ?><?= $isMs ? 'Profil Saya' : 'My Profile' ?><?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><?= $isMs ? 'Profil Saya' : 'My Profile' ?><?= $this->endSection() ?>

<?= $this->section('extra-css') ?>
<style>
    /* Glassmorphism Content Card */
    .glass-card-lg {
        background: rgba(255, 255, 255, 0.45) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4) !important;
        box-shadow: 0 20px 50px rgba(0,0,0,0.06) !important;
        border-radius: 1.5rem !important;
    }

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

    /* DIKECILKAN KEPADA 150PX (JUST NICE) */
    .profile-photo-wrap {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 24px;
        border: 4px solid rgba(255, 255, 255, 0.95);
        box-shadow: 0 8px 24px rgba(26, 35, 126, 0.15);
        overflow: visible;
        background: #ffffff;
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        object-fit: cover;
        display: block;
    }

    .profile-photo-fallback {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef3ff;
        color: #3246d3;
        font-size: 60px; /* Diubah suai saiz teks ikut 150px container */
        font-weight: 800;
    }

    /* CONTAINER BUTANG AKSI DI PENJURU BAWAH RAGRANG */
    .profile-actions-container {
        position: absolute;
        right: -8px;
        bottom: -8px;
        display: flex;
        z-index: 10;
    }

    .profile-photo-action {
        width: 38px; /* Dikecilkan sikit biar sepadan dengan 150px box */
        height: 38px;
        border-radius: 12px;
        border: 3px solid rgba(255, 255, 255, 0.95);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 14px rgba(123, 130, 196, 0.25);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .profile-photo-action:hover {
        transform: translateY(-1px) scale(1.03);
    }

    .btn-action-upload {
        background: linear-gradient(135deg, #c9c4ff 0%, #b6c8ff 100%);
        color: #4f5fa8;
    }

    .btn-action-upload:hover {
        background: linear-gradient(135deg, #beb8ff 0%, #a9beff 100%);
        color: #465598;
    }

    .profile-photo-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        width: 195px;
        background: rgba(255, 255, 255, 0.96);
        border-radius: 14px;
        box-shadow: 0 12px 28px rgba(18, 23, 38, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.95);
        overflow: hidden;
        display: none;
        z-index: 30;
    }

    .profile-photo-menu.show {
        display: block;
    }

    .profile-photo-menu-btn {
        width: 100%;
        border: none;
        background: transparent;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        font-size: 14px;
        font-weight: 700;
        color: #3f4655;
        text-align: left;
        transition: background 0.15s ease;
    }

    .profile-photo-menu-btn:hover {
        background: #f5f7ff;
    }

    .profile-photo-menu-btn.danger {
        color: #f1416c;
    }

    .profile-photo-menu-btn.danger:hover {
        background: #fff5f8;
    }

    .profile-photo-menu-divider {
        height: 1px;
        background: #eceff7;
        margin: 0;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    $user = $user ?? auth()->user();
    $isUrusetia = (bool) ($isUrusetia ?? false);
    $urusetiaInfo = $urusetiaInfo ?? null;
    $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
    $fullName = $fullName !== '' ? $fullName : ($user->username ?? ($isMs ? 'Pengguna' : 'User'));
    $firstName = trim((string) ($user->first_name ?? ''));
    $lastName = trim((string) ($user->last_name ?? ''));
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
    if ($initials === '') {
        $initials = strtoupper(substr((string) ($user->username ?? 'U'), 0, 2));
    }
    $avatar = trim((string) ($user->profile_image ?? ''));
    $avatarUrl = $avatar !== '' ? base_url($avatar) : null;

    $authIconClass = $isUrusetia ? 'ki-setting-3 fs-1 text-warning' : 'ki-shield-search fs-1 text-success';
    $authTitle = $isUrusetia ? 'Kakitangan (Unit Kerjaya)' : 'Kakitangan (Penyelia PTJ)';
    $authDesc = $isUrusetia
        ? 'Kuasa Kelulusan Akhir & Payroll Sistem'
        : 'Kuasa Pengurusan Calon & Dana Jabatan';
    $authBadgeClass = $isUrusetia ? 'badge-light-warning text-warning' : 'badge-light-success text-success';
    $authBadgeText = $isUrusetia ? 'Urusetia' : 'Penyelia';
?>

<div class="card glass-card-lg w-100 max-w-1100px mx-auto animate__animated animate__fadeIn">
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

        <form action="<?= site_url('profil') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-8 text-start">
                
                <div class="col-lg-4 d-flex flex-column align-items-center text-center border-end border-gray-300 border-opacity-40 pe-lg-8 justify-content-center">
                    <label class="form-label fw-bold text-gray-800 fs-6 mb-4"><?= $isMs ? 'Gambar Profil Semasa' : 'Current Profile Picture' ?></label>
                    
                    <div class="mb-5 profile-photo-wrap" data-initial-avatar="<?= $avatarUrl ? '1' : '0' ?>">
                        <?php if ($avatarUrl): ?>
                            <img src="<?= esc($avatarUrl) ?>" alt="Avatar" id="profile_avatar_img" class="profile-photo" />
                        <?php else: ?>
                            <div class="profile-photo-fallback" id="profile_avatar_fallback"><?= esc($initials) ?></div>
                        <?php endif; ?>

                        <input type="hidden" name="remove_profile_image" id="remove_profile_image" value="0">
                        
                        <div class="profile-actions-container">
                        <button type="button" id="upload_profile_image_btn" class="profile-photo-action btn-action-upload" title="<?= $isMs ? 'Urus Gambar' : 'Manage Picture' ?>">
                            <i class="fa-solid fa-camera fs-4"></i>
                        </button>

                            <div id="profile_photo_menu" class="profile-photo-menu">
                                <button type="button" id="menu_upload_btn" class="profile-photo-menu-btn">
                                    <i class="ki-duotone ki-picture fs-5 text-primary"><span class="path1"></span><span class="path2"></span></i>
                                    <span><?= $isMs ? 'Pilih Gambar Baru' : 'Choose New Image' ?></span>
                                </button>
                                <div id="remove_menu_divider" class="profile-photo-menu-divider" style="<?= $avatarUrl ? '' : 'display:none;' ?>"></div>
                                <button type="button" id="remove_profile_image_btn" class="profile-photo-menu-btn danger" style="<?= $avatarUrl ? '' : 'display:none;' ?>">
                                    <i class="ki-duotone ki-trash fs-5 text-danger">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                    </i>
                                    <span><?= $isMs ? 'Buang Gambar' : 'Remove Image' ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-100 px-4">
                        <input type="file" name="profile_image" id="profile_image_input" class="form-control glass-input fs-7 position-absolute opacity-0" accept=".jpg,.jpeg,.png,.webp" style="width:1px;height:1px;left:-9999px;pointer-events:none;">
                        <button type="button" class="btn btn-sm btn-light-primary w-100 fw-bold d-lg-none mb-2" onclick="document.getElementById('profile_image_input').click()"><?= $isMs ? 'Pilih Fail' : 'Choose File' ?></button>
                        <div class="text-muted fs-8 mt-2"><?= $isMs ? 'Format' : 'Format' ?>: <strong>JPG, PNG, WEBP</strong> (<?= $isMs ? 'Maks' : 'Max' ?> 2MB).</div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h3 class="fw-bolder text-gray-900 mb-6 fs-4 d-flex align-items-center">
                        <i class="ki-duotone ki-profile-user fs-2 text-primary me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        <?= $isMs ? 'Maklumat Identiti Pengguna' : 'User Identity Information' ?>
                    </h3>
                    
                    <div class="row g-5">
                        <div class="col-md-6">
                            <label class="form-label required fw-bold text-gray-700 fs-7"><?= $isMs ? 'Nama Depan' : 'First Name' ?></label>
                            <input type="text" name="first_name" class="form-control glass-input" value="<?= esc(old('first_name', $user->first_name ?? '')) ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label required fw-bold text-gray-700 fs-7"><?= $isMs ? 'Nama Belakang' : 'Last Name' ?></label>
                            <input type="text" name="last_name" class="form-control glass-input" value="<?= esc(old('last_name', $user->last_name ?? '')) ?>" required>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label required fw-bold text-gray-700 fs-7"><?= $isMs ? 'Alamat Emel Rasmi' : 'Official Email Address' ?></label>
                            <input type="email" name="email" class="form-control glass-input" value="<?= esc(old('email', $user->email ?? '')) ?>" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-gray-600 fs-7 mb-2"><?= $isMs ? 'Peranan Dalam Sistem' : 'Role in System' ?></label>
                            <div class="d-flex align-items-center justify-content-start gap-2 flex-wrap">
                                <?php if ($user->inGroup('student')): ?>
                                    <span class="badge badge-light-info fw-bolder px-4 py-2 fs-7 text-uppercase tracking-wide"><?= $isMs ? 'Pelajar' : 'Student' ?></span>
                                <?php endif; ?>
                                <?php if ($user->inGroup('supervisor')): ?>
                                    <span class="badge badge-light-success fw-bolder px-4 py-2 fs-7 text-uppercase tracking-wide"><?= $isMs ? 'Penyelia' : 'Supervisor' ?></span>
                                <?php endif; ?>
                                <?php if ($user->inGroup('career')): ?>
                                    <span class="badge badge-light-warning fw-bolder px-4 py-2 fs-7 text-uppercase tracking-wide"><?= $isMs ? 'Urusetia' : 'Career Secretariat' ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed border-gray-400 my-8"></div>

            <div class="text-start">
                <h3 class="fw-bolder text-gray-900 mb-5 fs-4 d-flex align-items-center">
                    <i class="ki-duotone ki-security-user fs-2 text-info me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    Akaun Autentikasi Kumpulan
                </h3>

                <div class="card glass-card-lg border-0 shadow-sm">
                    <div class="card-body p-6 d-flex align-items-center justify-content-between flex-wrap gap-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="symbol symbol-65px">
                                <span class="symbol-label bg-light">
                                    <i class="ki-duotone <?= esc($authIconClass) ?>"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                </span>
                            </div>
                            <div>
                                <div class="fw-bolder text-gray-900 fs-5 mb-1"><?= esc($authTitle) ?></div>
                                <div class="text-muted fs-7"><?= esc($authDesc) ?></div>
                            </div>
                        </div>

                        <span class="badge <?= esc($authBadgeClass) ?> fw-bolder px-4 py-2 fs-7"><?= esc($authBadgeText) ?></span>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed border-gray-400 my-8"></div>

            <div class="text-start">
                <h3 class="fw-bolder text-gray-900 mb-2 fs-4 d-flex align-items-center">
                    <i class="ki-duotone ki-key fs-2 text-warning me-2"><span class="path1"></span><span class="path2"></span></i>
                    <?= $isMs ? 'Tukar Kata Laluan Keselamatan' : 'Change Security Password' ?>
                </h3>
                <p class="text-muted fs-7 mb-6"><?= $isMs ? 'Isi bahagian di bawah sekiranya anda berniat untuk menukar kod kelayakan akses semasa anda sahaja.' : 'Fill in the section below only if you want to change your current login credentials.' ?></p>
                
                <div class="row g-5">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-gray-700 fs-7"><?= $isMs ? 'Kata Laluan Semasa' : 'Current Password' ?></label>
                        <input type="password" name="current_password" class="form-control glass-input" value="" autocomplete="current-password">
                    </div>
                    
                    <div class="col-md-4" data-kt-password-meter="true">
                        <label class="form-label fw-bold text-gray-700 fs-7"><?= $isMs ? 'Kata Laluan Baharu' : 'New Password' ?></label>
                        <div class="position-relative mb-3">
                            <input type="password" name="new_password" class="form-control glass-input" value="" autocomplete="new-password">
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="ki-duotone ki-eye-slash fs-2"></i>
                                <i class="ki-duotone ki-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-center mb-2" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <div class="text-muted fs-8 fw-semibold leading-sm mt-2">
                            <?= $isMs ? 'Minimum 8 aksara, gabungan huruf besar, huruf kecil, nombor, dan simbol.' : 'Minimum 8 characters, with uppercase, lowercase, number, and symbol.' ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-gray-700 fs-7"><?= $isMs ? 'Sahkan Kata Laluan Baharu' : 'Confirm New Password' ?></label>
                        <input type="password" name="confirm_password" class="form-control glass-input" value="" autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed border-gray-400 my-8"></div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="submit" class="btn btn-primary fw-bold px-8 shadow-sm">
                    <?= $isMs ? 'Simpan Perubahan' : 'Save Changes' ?>
                </button>
            </div>
        </form>

        <div class="mt-8">
            <div class="card glass-card-lg border-0 shadow-sm">
                <div class="card-body p-6">
                    <?php if ($isUrusetia): ?>
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                            <h4 class="fw-bolder text-gray-900 fs-5 mb-0">Ringkasan Peruntukan Bajet (<?= date('Y') ?>)</h4>
                            <span class="badge badge-light-warning text-warning fw-bolder">Urusetia</span>
                        </div>
                        <div class="row g-5">
                            <div class="col-md-4">
                                <div class="bg-white bg-opacity-50 rounded-3 p-4 h-100">
                                    <div class="text-muted fs-8 mb-1">Bajet Tahunan</div>
                                    <div class="fw-bolder fs-3 text-gray-900">RM 1,200,000</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-white bg-opacity-50 rounded-3 p-4 h-100">
                                    <div class="text-muted fs-8 mb-1">Telah Diguna</div>
                                    <div class="fw-bolder fs-3 text-warning">RM 846,500</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-white bg-opacity-50 rounded-3 p-4 h-100">
                                    <div class="text-muted fs-8 mb-1">Baki Semasa</div>
                                    <div class="fw-bolder fs-3 text-success">RM 353,500</div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                            <h4 class="fw-bolder text-gray-900 fs-5 mb-0">Statistik Operasi Penyelia PTJ</h4>
                            <span class="badge badge-light-success text-success fw-bolder">Penyelia</span>
                        </div>
                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="bg-white bg-opacity-50 rounded-3 p-4 h-100">
                                    <div class="text-muted fs-8 mb-1">Iklan Kerja Aktif</div>
                                    <div class="fw-bolder fs-3 text-success">12</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white bg-opacity-50 rounded-3 p-4 h-100">
                                    <div class="text-muted fs-8 mb-1">Timesheet Menunggu Pengesahan</div>
                                    <div class="fw-bolder fs-3 text-primary">34</div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const removeInput = document.getElementById('remove_profile_image');
    const removeBtn = document.getElementById('remove_profile_image_btn');
    const uploadBtn = document.getElementById('upload_profile_image_btn');
    const menuUploadBtn = document.getElementById('menu_upload_btn');
    const menu = document.getElementById('profile_photo_menu');
    const removeMenuDivider = document.getElementById('remove_menu_divider');
    const uploadInput = document.getElementById('profile_image_input');
    
    const wrapElement = document.querySelector('.profile-photo-wrap');
    const initialHasAvatar = wrapElement && wrapElement.dataset.initialAvatar === '1';

    if (!removeInput || !uploadInput) return;

    function closeMenu() {
        if (menu) menu.classList.remove('show');
    }

    function setRemoveMenuVisible(visible) {
        if (removeBtn) {
            removeBtn.style.display = visible ? 'flex' : 'none';
        }
        if (removeMenuDivider) {
            removeMenuDivider.style.display = visible ? 'block' : 'none';
        }
    }

    if (uploadBtn) {
        uploadBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (menu) {
                menu.classList.toggle('show');
            }
        });
    }

    if (menuUploadBtn) {
        menuUploadBtn.addEventListener('click', function () {
            closeMenu();
            uploadInput.click();
        });
    }

    if (removeBtn) {
        removeBtn.addEventListener('click', function () {
            closeMenu();
            removeInput.value = initialHasAvatar ? '1' : '0';
            uploadInput.value = '';
            
            const currentImg = document.getElementById('profile_avatar_img');
            if (currentImg) {
                currentImg.remove();
            }

            if (!document.getElementById('profile_avatar_fallback')) {
                const fallback = document.createElement('div');
                fallback.id = 'profile_avatar_fallback';
                fallback.className = 'profile-photo-fallback';
                fallback.innerText = '<?= esc($initials) ?>';
                wrapElement.insertBefore(fallback, removeInput);
            }

            setRemoveMenuVisible(false);
        });
    }

    document.addEventListener('click', function (e) {
        if (!menu || !uploadBtn) return;
        if (!menu.contains(e.target) && !uploadBtn.contains(e.target)) {
            closeMenu();
        }
    });

    uploadInput.addEventListener('change', function () {
        if (uploadInput.files && uploadInput.files.length > 0) {
            closeMenu();
            removeInput.value = '0';
            setRemoveMenuVisible(true);
            
            const reader = new FileReader();
            reader.onload = function(e) {
                let fallbackElement = document.getElementById('profile_avatar_fallback');
                if (fallbackElement) {
                    fallbackElement.remove();
                }
                
                let currentImg = document.getElementById('profile_avatar_img');
                if (!currentImg) {
                    currentImg = document.createElement('img');
                    currentImg.id = 'profile_avatar_img';
                    currentImg.className = 'profile-photo';
                    wrapElement.insertBefore(currentImg, removeInput);
                }
                currentImg.src = e.target.result;
                currentImg.style.display = 'block';
            }
            reader.readAsDataURL(uploadInput.files[0]);
        }
    });
});
</script>
<?= $this->endSection() ?>
