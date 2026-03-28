<?php

namespace App\Http\Controllers;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
   use App\Http\Requests\StoreProjetRequest;

class ProjetController extends Controller
{
   public function index()
    {
        $projets = Projet::with('user')->get();
        $users = User::all();
        return view('admin.projets.index', compact('projets', 'users'));
    }

public function store(StoreProjetRequest $request)
{

    Projet::create([
        'nom' => $request->titre,
        'date_debut' => $request->date_debut,
        'date_fin_prevue' => now()->addMonths(3),
        'budget' => $request->budget ?? 0,
        'chef_projet_id' => $request->user_id,
    ]);

    return back()->with('success', 'Projet ajouté avec succès !');
}
public function destroy(Projet $projet)
{
    $projet->delete();
    return back()->with('success', 'Le projet a été supprimé avec succès !');
}
public function edit(Projet $projet)
{
    return view('admin.projets.edit', compact('projet'));
}

public function update(Request $request, $id)
{
    $projet = Projet::find($id);

    if (!$projet) {
        return back()->with('error', 'Projet introuvable');
    }

    $projet->nom = $request->nom;
    $projet->budget = $request->budget;
    $projet->date_debut = $request->date_debut;

    $projet->save();

    return redirect()->route('admin.projets.index')->with('success', 'Modifié avec succès !');
}
}
