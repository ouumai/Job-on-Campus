<?php namespace App\Libraries;

use App\Models\IklanKerjaModel;

class JobAdService {
    protected $model;

    public function __construct() {
        $this->model = new IklanKerjaModel();
    }

    public function submitForApproval($id) {
        // Logic: Tukar status ikut jenis peruntukan (PTJ/Career/Projek)
    }

    public function approveCareer($id) {
        // Logic: Urusetia luluskan iklan (Status -> Active)
    }
}