<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditVirementController extends Controller
{
    public function lists() {
        $auditVirements = DB::table('audit_virement')->get();

        return view('audit_virements', [
            'virements' => $auditVirements
        ]);
    }
}
