<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\User;


class dashboardController extends Controller
{
    public function index()
{
    $data = [
        'totalEmployes'      => User::where('role', 'employe')->count(),
        'absencesEnAttente'  => Absence::where('statut', 'en_attente')->count(),
        'absentsAujourdhui'  => Absence::where('statut', 'valide')
                                    ->whereDate('date_debut', '<=', now())
                                    ->whereDate('date_fin', '>=', now())
                                    ->count(),
        'dernieresAbsences'  => Absence::with('user')->where('statut', 'en_attente')->limit(5)->latest()->get(),
    ];

    return view('rh.dashboard', $data);
}
}
