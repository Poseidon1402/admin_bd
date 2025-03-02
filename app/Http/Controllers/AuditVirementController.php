<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuditVirementController extends Controller
{
    public function lists() {
        $auditVirements = DB::table('audit_virement')->where('numero_compte', '=', Auth::user()->num_compte)->get();

        return view('audit_virements', [
            'virements' => $auditVirements,
            'ajout' => $auditVirements->groupBy('type_action')->has('ajout') ? $auditVirements->groupBy('type_action')['ajout']->count() : 0,
            'modification' => $auditVirements->groupBy('type_action')->has('modification') ? $auditVirements->groupBy('type_action')->get('modification')->count() : 0,
            'suppression' => $auditVirements->groupBy('type_action')->has('suppression') ? $auditVirements->groupBy('type_action')->get('suppression')->count() : 0
        ]);
    }
}
