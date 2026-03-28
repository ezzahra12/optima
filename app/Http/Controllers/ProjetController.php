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
        return view('projets.index', compact('projets', 'users'));
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
// 1. كيعرض لينا الصفحة ديال Edit
public function edit(Projet $projet)
{
    return view('projets.edit', compact('projet'));
}

// 2. كياخد المعلومات الجديدة وكيحدثها
public function update(Request $request, $id)
{
    // 1. كنجيبو المشروع
    $projet = Projet::find($id);

    if (!$projet) {
        return back()->with('error', 'Projet introuvable');
    }

    // 2. التحديث (تأكدي من أسماء الحقول اللي في الفورم)
    $projet->nom = $request->nom;
    $projet->budget = $request->budget;
    $projet->date_debut = $request->date_debut;

    // 3. الحفظ الضروري
    $projet->save();

    return redirect()->route('projets.index')->with('success', 'Modifié avec succès !');
}
}
