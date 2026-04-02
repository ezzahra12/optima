<?php

namespace App\Http\Controllers\Chef;
use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\User;
use App\Models\Tache;
use Illuminate\Http\Request;

class ProjetDetailsController extends Controller
{
    public function show($id)
    {

        $projet = Projet::with(['taches.user', 'departement'])->findOrFail($id);

         $all_users = User::where('role', 'employe')->get();
        return view('chef.projets.show', compact('projet', 'all_users'));
    }

    public function addMembre(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $projet = Projet::findOrFail($id);

    $projet->membres()->syncWithoutDetaching([$request->user_id]);

    return back()->with('success', 'Membre ajouté à l\'équipe !');
}

public function destroyTache($id)
{
    $tache = Tache::findOrFail($id);
    $tache->delete();

    return back()->with('success', 'Tâche supprimée ');
}
    public function storeTache(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'projet_id' => 'required|exists:projets,id',

        ]);

        Tache::create([
            'titre' => $request->titre,
            'user_id' => $request->user_id,
            'projet_id' => $request->projet_id,
            'statut' => 'a_faire',
            'date_limite' => $request->date_limite,
        ]);

        return back()->with('success', 'Tâche ajoutée avec succès !');
    }
}
