<?= $this->extend('layouts/main') ?>

<?= $this->section('page-title') ?>
    <?= lang('Joc.title_dashboard') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?php 
        $role = $role ?? session()->get('role'); // Ambil peranan semasa dari controller atau sesi
        
        if ($role === 'student'): 
            // Muat naik dashboard pelajar (Seksyen 7.2) [cite: 67]
            echo view('pelajar/semakan'); 
            
        elseif ($role === 'supervisor'): 
            // Muat naik dashboard penyelia (Seksyen 7.3) [cite: 75]
            echo view('penyelia/senarai'); 
            
        elseif ($role === 'career'): 
            // Muat naik dashboard urusetia (Seksyen 7.4) [cite: 90]
            echo view('urusetia/pengguna/dashboard'); 
            
        endif; 
    ?>
<?= $this->endSection() ?>