<?php

namespace App\Http\Controllers;

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
        DB::table('virements')->insert([
            'num_compte' => '0001',
            'montant' => $request->montant
        ]);

        return redirect()->intended('/virements');
    }
}
