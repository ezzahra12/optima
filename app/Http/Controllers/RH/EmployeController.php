<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
class EmployeController extends Controller
{
  public function index()
{
    $employes = User::where('role', '!=', 'admin')
        ->with(['paiements' => function($q) {
            $q->where('mois', now()->format('F Y'));
        }])
        ->withCount(['absences' => function ($q) {
            $q->whereMonth('date_debut', now()->month)->where('statut', 'valide');
        }])
        ->get();

    return view('rh.employes.index', compact('employes'));
}
}
