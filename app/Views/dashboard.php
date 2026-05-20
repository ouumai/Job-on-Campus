<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    <?= lang('Joc.title_dashboard') ?>
<?= $this->endSection() ?>

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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card glass-card mb-8">
    <div class="card-body p-10">

        <?php 
            $user = auth()->user();
            $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            if (empty($fullName)) {
                $fullName = $user->username ?? lang('Joc.role_guest');
            }

            $isUrusetia = false;
            if ($user && ! $user->inGroup('student')) {
                $urusetiaModel = model(\App\Models\UrusetiaModel::class);
                $checkUrusetia = $urusetiaModel->getByUkmper((string) ($user->username ?? ''));
                if ($checkUrusetia && (int) (($checkUrusetia->aktif ?? 0)) === 1) {
                    $isUrusetia = true;
                }
            }
        ?>
        <h1 class="fw-bolder text-gray-900 mb-3 fs-1 text-start mt-2">
            <?= lang('Joc.welcome_greeting') ?>, <?= esc($fullName) ?>!
        </h1>
        
        <div class="separator separator-dashed border-gray-300 my-3"></div>

        <div class="text-gray-800 fs-5 mb-4 text-start" style="line-height: 1.8; text-align: justify !important;">
            <?php if ($user->inGroup('student')): ?>
                <?= lang('Joc.welcome_student_intro') ?>
                
                <ul class="list-unstyled mt-6 ms-2 row g-4">
                    <div class="col-md-6">
                        <li class="d-flex align-items-center bg-white bg-opacity-40 p-3 rounded-3 border border-white">
                            <i class="ki-duotone ki-check-circle fs-2 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fw-semibold text-gray-800 fs-6"><?= lang('Joc.welcome_student_1') ?></span>
                        </li>
                    </div>
                    <div class="col-md-6">
                        <li class="d-flex align-items-center bg-white bg-opacity-40 p-3 rounded-3 border border-white">
                            <i class="ki-duotone ki-check-circle fs-2 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fw-semibold text-gray-800 fs-6"><?= lang('Joc.welcome_student_2') ?></span>
                        </li>
                    </div>
                    <div class="col-md-6">
                        <li class="d-flex align-items-center bg-white bg-opacity-40 p-3 rounded-3 border border-white">
                            <i class="ki-duotone ki-check-circle fs-2 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fw-semibold text-gray-800 fs-6"><?= lang('Joc.welcome_student_3') ?></span>
                        </li>
                    </div>
                    <div class="col-md-6">
                        <li class="d-flex align-items-center bg-white bg-opacity-40 p-3 rounded-3 border border-white">
                            <i class="ki-duotone ki-check-circle fs-2 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fw-semibold text-gray-800 fs-6"><?= lang('Joc.welcome_student_4') ?></span>
                        </li>
                    </div>
                    <div class="col-md-12">
                        <li class="d-flex align-items-center bg-white bg-opacity-40 p-3 rounded-3 border border-white">
                            <i class="ki-duotone ki-check-circle fs-2 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fw-semibold text-gray-800 fs-6"><?= lang('Joc.welcome_student_5') ?></span>
                        </li>
                    </div>
                </ul>
                
            <?php elseif ($isUrusetia || $user->inGroup('career')): ?>
                <?= lang('Joc.welcome_career_intro') ?>
                
            <?php elseif ($user->inGroup('supervisor')): ?>
                <?= lang('Joc.welcome_supervisor_intro') ?>
            <?php endif; ?>
        </div>
        
    </div>
</div>

<div class="row g-6 text-start mb-4">
            
    <div class="col-lg-4 d-flex flex-column gap-6">
        <div class="card glass-card border border-white p-6 flex-grow-1">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50px me-4">
                    <div class="symbol-label bg-white bg-opacity-50 text-primary border border-white">
                        <i class="ki-duotone ki-briefcase fs-2hx text-primary"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div>
                    <div class="fs-2 fw-bolder text-gray-900"><?= lang('Joc.dashboard_active_jobs_count') ?></div>
                    <div class="fw-semibold text-muted fs-7"><?= lang('Joc.dashboard_active_applications') ?></div>
                </div>
            </div>
        </div>

        <div class="card glass-card border border-white p-6 flex-grow-1">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50px me-4">
                    <div class="symbol-label bg-white bg-opacity-50 text-success border border-white">
                        <i class="ki-duotone ki-wallet fs-2hx text-success"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                    </div>
                </div>
                <div>
                    <div class="fs-2 fw-bolder text-gray-900">RM 100.00</div>
                    <div class="fw-semibold text-muted fs-7"><?= lang('Joc.dashboard_estimated_claim') ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card glass-card border border-white p-6 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex flex-stack mb-5">
                <div class="d-flex align-items-center">
                    <i class="ki-duotone ki-chart-line fs-2 text-info me-2"><span class="path1"></span><span class="path2"></span></i>
                    <span class="fs-6 fw-bold text-gray-900"><?= lang('Joc.dashboard_weekly_hours_title') ?></span>
                </div>
                <span class="badge bg-white bg-opacity-60 text-info fw-bold px-3 py-1 fs-8 border border-white"><?= lang('Joc.dashboard_month_year') ?></span>
            </div>
            
            <div class="flex-grow-1">
                <div id="kt_joc_stats_chart" style="min-height: 160px;"></div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var element = document.getElementById('kt_joc_stats_chart');
    if (!element) return;

    var options = {
        series: [{
            name: <?= json_encode(lang('Joc.dashboard_series_working_hours')) ?>,
            data: [6, 8] // Cukupkan 4 data untuk plot Minggu 1 - Minggu 4
        }],
        chart: {
            type: 'area',
            height: 160,
            toolbar: { show: false },
            sparkline: { enabled: false }
        },
        colors: ['#0052D4'], 
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 4,
            hover: {
                size: 6
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.02,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: [
                <?= json_encode(lang('Joc.dashboard_week_1')) ?>,
                <?= json_encode(lang('Joc.dashboard_week_2')) ?>,
                <?= json_encode(lang('Joc.dashboard_week_3')) ?>,
                <?= json_encode(lang('Joc.dashboard_week_4')) ?>
            ],
            axisBorder: { show: false },
            axisTicks: { show: false },
            tooltip: { enabled: false },
            labels: {
                style: { colors: '#5e6278', fontSize: '11px', fontWeight: '500' }
            }
        },
        yaxis: {
            labels: {
                style: { colors: '#5e6278', fontSize: '11px', fontWeight: '500' }
            }
        },
        tooltip: {
            shared: false,
            intersect: false,
            style: { fontSize: '12px' },
            y: {
                formatter: function (val) { return val + " " + <?= json_encode(lang('Joc.dashboard_hour_unit')) ?>; }
            }
        },
        grid: {
            borderColor: 'rgba(0, 0, 0, 0.05)',
            strokeDashArray: 4,
            yaxis: { lines: { show: true } }
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
});
</script>
<?= $this->endSection() ?>
