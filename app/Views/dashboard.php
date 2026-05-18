<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    <?= lang('Joc.title_dashboard') ?>
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
            <?= lang('Joc.welcome_greeting') ?>, <?= esc($fullName) ?>!
        </h1>
        
        <div class="separator separator-dashed border-gray-300 my-6"></div>

        <div class="text-gray-800 fs-4 mb-8 text-start" style="line-height: 1.8; text-align: justify !important;">
            <?php if ($user->inGroup('student')): ?>
                <?= lang('Joc.welcome_student_intro') ?>
                <ul class="list-unstyled mt-4 ms-6">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_student_1') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_student_2') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_student_3') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_student_4') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_student_5') ?>
                    </li>
                </ul>
                
            <?php elseif ($user->inGroup('supervisor')): ?>
                <?= lang('Joc.welcome_supervisor_intro') ?>
                <ul class="list-unstyled mt-4 ms-6">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_supervisor_1') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_supervisor_2') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_supervisor_3') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_supervisor_4') ?>
                    </li>
                </ul>
                
            <?php elseif ($user->inGroup('career')): ?>
                <?= lang('Joc.welcome_career_intro') ?>
                <ul class="list-unstyled mt-4 ms-6">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_career_1') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_career_2') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_career_3') ?>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ki-duotone ki-check-circle fs-3 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                        <?= lang('Joc.welcome_career_4') ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>