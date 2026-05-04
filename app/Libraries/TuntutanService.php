<?php namespace App\Libraries;

use App\Models\TuntutanModel;

class TuntutanService {
    public function submitClaim($data, $filePath) {
        // Logic: Ambil jam dari timesheet, kira bayaran, simpan rekod
    }

    public function supervisorVerify($claimId) {
        // Logic: Penyelia sahkan sebelum hantar ke KP/Urusetia
    }
}