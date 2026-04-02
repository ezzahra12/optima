<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tache;

class TacheController extends Controller
{
// public function store(Request $request) {
//     dd("أنا خدام من هاد الـ Controller بالضبط!");
//     $request->validate([
//         'titre' => 'required',
//         'projet_id' => 'required',
//         'user_id' => 'required',
//     ]);

//     $tache = new Tache();
//     $tache->titre = $request->titre;
//     $tache->projet_id = $request->projet_id;
//     $tache->user_id = $request->user_id;
//     $tache->date_limite = $request->date_limite ?? now();
//     $tache->statut = 'a_faire';

//     $tache->save();


//     return back()->with('success', 'Tâche créée avec statut: ' . $tache->statut);
// }
}
