<?php

namespace App\Http\Controllers;

use App\Models\Virement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VirementController extends Controller
{
    public function lists() {
        $virements = DB::table('virements')->get();

        return view('virements', [
            'virements' => $virements
        ]);
    }

    public function store(Request $request) {
        $virement = Virement::create([
            'num_compte' => '0001',
            'montant' => 500,
        ]);

        DB::table('audit_virement')->insert([
            'type_action' => 'ajout',
            'date_operation' => now(),
            'numero_virement' => $virement->num_virements,
            'numero_compte' => '0001',
            'nom_client' => 'Marie Curie',
            'date_virement' => now(),
            'montant_ancien' => 800.00,
            'montant_nouv' => 1200.00,
        ]);

        return redirect()->intended('/virements');
    }
}
