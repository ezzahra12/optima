<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;

class SalaireController extends Controller
{


public function storePrime(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'prime' => 'required|numeric|min:0',
        'motif' => 'required|string|max:100',
    ]);

    Paiement::updateOrCreate(
        [
            'user_id' => $request->user_id,
            'mois' => now()->format('F Y'),
            'statut' => 'en_attente'
        ],
        [
            'prime' => $request->prime,
            'motif_prime' => $request->motif,
            'montant' => User::find($request->user_id)->salaire
        ]
    );

    return back()->with('success', 'Élément de paie transmis au comptable !');
}
public function storeComplet(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'montant' => 'required|numeric', // Salaire ajustable
        'prime'   => 'nullable|numeric',
        'motif'   => 'nullable|string|max:255',
    ]);

    Paiement::updateOrCreate(
        [
            'user_id' => $request->user_id,
            'mois'    => now()->format('F Y'),
            'statut'  => 'en_attente'
        ],
        [
            'montant'     => $request->montant,
            'prime'       => $request->prime ?? 0,
            'motif_prime' => $request->motif,
        ]
    );

    return back()->with('success', "Éléments de paie enregistrés.");
}
}
