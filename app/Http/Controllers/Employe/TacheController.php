<?php

namespace App\Http\Controllers\Employe;

// use Absence as GlobalAbsence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tache;
use App\Models\Absence;
class TacheController extends Controller
{
public function index() {
    $taches = auth()->user()->taches;
    $absences = auth()->user()->absences;
    // $taches = Tache::where('user_id', auth()->id())->get();
    // $absences = Absence::where('user_id', auth()->id())->get();

    return view('employe.taches.index', compact('taches', 'absences'));
}
public function show($id)
{
    $tache = Tache::with(['projet.chef', 'projet.departement'])
                ->where('user_id', auth()->id())
                ->findOrFail($id);

    return view('employe.taches.show', compact('tache'));
}

public function updateStatus(Request $request, $id)
{
    $tache = Tache::where('user_id', auth()->id())->findOrFail($id);

    $request->validate([
        'statut' => 'required|in:a_faire,en_cours,termine',
    ]);

    $tache->update([
        'statut' => $request->statut
    ]);

    return redirect()->back()->with('success', 'Le statut de la mission a été mis à jour avec succès !');
}
}
