<?php

namespace App\Services;

/**
 * LocationService - Menguruskan laluan storan dan aset sistem
 */
class LocationService
{
    /**
     * Dapatkan laluan fizikal folder storan (writable)
     */
    public function getStorage()
    {
        // Guna WRITEPATH untuk simpan fail sulit seperti PDF surat tawaran
        return WRITEPATH . 'uploads/';
    }

    /**
     * Dapatkan URL untuk aset awam (CSS/JS/Imej)
     */
    public function getAssets()
    {
        return base_url('assets/');
    }

    /**
     * Dapatkan URL khusus untuk template Metronic v8.3.3 Demo 2
     * Penting untuk panggil plugins.bundle.css/js
     */
    public function getMetronic()
    {
        return base_url('assets/');
    }
}