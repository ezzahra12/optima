<?php

namespace App\Http\Controllers\Comptable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paiement;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
   public function index()
    {
        $moisActuel = now()->format('F Y');


        $masseSalariale = Paiement::where('mois', $moisActuel)
            ->select(DB::raw('SUM(montant + prime) as total'))
            ->first()->total ?? 0;

        $stats = [

            'total_masse_salariale' => $masseSalariale > 0 ? $masseSalariale : User::where('role', 'employe')->sum('salaire'),


            'paiements_en_attente'  => Paiement::where('mois', $moisActuel)->where('statut', 'en_attente')->count(),


            'dernieres_transactions' => Paiement::with('user')
                ->where('statut', 'termine')
                ->latest()
                ->take(5)
                ->get(),


            'total_employes' => User::whereNotIn('role', ['admin'])->count(),
        ];

        return view('comptable.dashboard', compact('stats'));
    }
}
