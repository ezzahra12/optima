<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
       $recentProjets = Projet::latest()->take(5)->get();
$derniersProjets = Projet::with('departement')->latest()->take(5)->get();
return view('admin.index', compact('totalProjets', 'totalUsers', 'totalBudget', 'projetsEnCours', 'recentProjets','derniersProjets'));
    }
}
