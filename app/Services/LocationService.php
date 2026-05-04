<?php

namespace App\Services;

class LocationService
{
    /**
     * Laluan aset awam (public/assets/)
     */
    public function getAssets()
    {
        return base_url('assets/');
    }

    /**
     * Laluan template Metronic Demo2
     */
    public function getMetronic()
    {
        return base_url('assets/templates/metronic/html/d2/');
    }
}