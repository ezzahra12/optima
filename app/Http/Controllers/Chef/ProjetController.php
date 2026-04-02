<?php

namespace App\Http\Controllers\Chef;
use App\Models\Projet;
use App\Models\User;
 use App\Http\Requests\StoreProjetRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProjetController extends Controller
{
public function index()
{
    $projets = Projet::where('chef_projet_id', auth()->id())
        ->with(['user', 'departement'])
        ->get();

    $projetsGroupes = $projets->groupBy('departement_id');


    $departements = auth()->user()->departements ?? collect();


    return view('chef.dashboard', compact('projets', 'projetsGroupes', 'departements'));
}
public function store(StoreProjetRequest $request)
{

    Projet::create([
        'nom' => $request->titre,
        'date_debut' => $request->date_debut,
        'date_fin_prevue' => now()->addMonths(3),
        'budget' => $request->budget ?? 0,
        'chef_projet_id' => auth()->id(),
    ]);

    return back()->with('success', 'Projet ajouté avec succès !');
}

public function dashboard()
{
    $projets = Projet::where('chef_projet_id', auth()->id())
        ->withCount('taches')
        ->withCount(['taches as taches_terminees_count' => function ($query) {
            $query->where('statut', 'Terminé');
        }])
        ->get();

    return view('chef.dashboard', compact('projets'));
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

