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
        'date_debut'   => 'required|date|after_or_equal:today',
        'nombre_jours' => 'required|integer|min:1',
        'motif'        => 'required|string|max:255',
    ]);
    $dateDebut = \Carbon\Carbon::parse($validated['date_debut']);
    $dateFin = $dateDebut->copy()->addDays($validated['nombre_jours'] - 1);

    Auth::user()->absences()->create([
        'date_debut' => $validated['date_debut'],
        'date_fin'   => $dateFin->format('Y-m-d'),
        'motif'      => $validated['motif'],
        'statut'     => 'en_attente',
    ]);

    return redirect()->back()->with('success', 'Demande envoyée avec succès !');
}



}
