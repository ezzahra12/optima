<?php

namespace App\Http\Controllers\Comptable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use App\Models\Paiement;



class SalaireController extends Controller
{
     public function index()
    {

        $employes = User::whereNotIn('role', ['admin', 'user'])
            ->with(['paiements' => function($q) {
                $q->where('mois', now()->format('F Y'));
            }])
            ->get();

        return view('comptable.salaires.index', compact('employes'));
    }

    public function validerPaiement(Request $request, $id)
    {
        $moisActuel = now()->format('F Y');

        $paiement = Paiement::where('user_id', $id)
                            ->where('mois', $moisActuel)
                            ->first();

        if (!$paiement) {
            $user = User::findOrFail($id);
            Paiement::create([
                'user_id' => $user->id,
                'montant' => $user->salaire,
                'prime'   => 0,
                'mois'    => $moisActuel,
                'statut'  => 'termine'
            ]);
        } else {
            $paiement->update(['statut' => 'termine']);
        }

        return back()->with('success', "Le virement a été marqué comme effectué.");
    }
}
