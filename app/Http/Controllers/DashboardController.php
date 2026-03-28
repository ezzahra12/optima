<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
        return redirect('/projets');
    }
        $totalProjets = Projet::count();
        $totalUsers = User::count();
        $totalBudget = Projet::sum('budget');
        $projetsEnCours = Projet::where('statut', 'En cours')->count();

        return view('dashboard', compact('totalProjets', 'totalUsers', 'totalBudget', 'projetsEnCours'));
    }
}
