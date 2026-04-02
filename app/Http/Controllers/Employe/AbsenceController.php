<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
   public function index()
{
    $absences = Auth::user()->absences()->latest()->get();


    $solde = 18 - Auth::user()->absences()->where('statut', 'valide')->count();

    return view('employe.absences.index', compact('absences', 'solde'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'typeAbsence' => 'required|string|max:255',
        'date_debut'  => 'required|date|after_or_equal:today',
        'date_fin'    => 'required|date|after_or_equal:date_debut',
    ]);

    Auth::user()->absences()->create([
        'typeAbsence' => $validated['typeAbsence'],
        'date_debut'  => $validated['date_debut'],
        'date_fin'    => $validated['date_fin'],
        'statut'      => 'en_attente',
    ]);

    return redirect()->back()->with('success', 'Demande envoyée !');
}



}
