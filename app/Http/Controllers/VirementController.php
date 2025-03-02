<?php

namespace App\Http\Controllers;

use App\Models\Virement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VirementController extends Controller
{
    public function lists() {
        $virements = DB::table('virements')->where('num_compte', '=', Auth::user()->num_compte)->get();

        return view('virements', [
            'virements' => $virements
        ]);
    }

    public function store(Request $request) {
        $user = Auth::user();
        $virement = Virement::create([
            'num_compte' => $user->num_compte,
            'montant' => $request->montant,
        ]);

        DB::table('audit_virement')->insert([
            'type_action' => 'ajout',
            'date_operation' => now(),
            'numero_virement' => $virement->num_virements,
            'numero_compte' => $user->num_compte,
            'nom_client' => $user->nom,
            'date_virement' => now(),
            'montant_ancien' => $user->solde,
            'montant_nouv' => $user->solde + $request->montant,
        ]);

        $user->solde = $user->solde + $request->montant;
        $user->save();
        
        return redirect()->intended('/virements');
    }

    public function delete(int $numVirements, int $montant) {
        $user = Auth::user();

        DB::table('audit_virement')->insert([
            'type_action' => 'suppression',
            'date_operation' => now(),
            'numero_virement' => $numVirements,
            'numero_compte' => $user->num_compte,
            'nom_client' => $user->nom,
            'date_virement' => now(),
            'montant_ancien' => $user->solde,
            'montant_nouv' => $user->solde - $montant,
        ]);

        $virement = Virement::find($numVirements);
        $virement->delete();

        $user->solde = $user->solde - $montant;
        $user->save();
        
        return redirect()->intended('/virements');
    }

    public function update(Request $request, $num_virement)
    {
        $virement = Virement::find($num_virement);
        $virement->montant = $request->montant;
        $ancienMontant = $request->montant_ancien;
        $virement->save();

        $user = Auth::user();
        
        DB::table('audit_virement')->insert([
            'type_action' => 'modification',
            'date_operation' => now(),
            'numero_virement' => $virement->num_virements,
            'numero_compte' => $user->num_compte,
            'nom_client' => $user->nom,
            'date_virement' => now(),
            'montant_ancien' => $user->solde,
            'montant_nouv' => $user->solde - $ancienMontant + $request->montant,
        ]);

        $user->solde = $user->solde - $ancienMontant + $request->montant;
        $user->save();

        return redirect()->route('virements_list')->with('success', 'Virement modifié avec succès.');
    }
}
