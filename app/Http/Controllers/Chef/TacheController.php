<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tache;

class TacheController extends Controller
{
    public function store(Request $request) {
    $request->validate([
        'titre' => 'required',
        'projet_id' => 'required',
        'user_id' => 'required',
    ]);

    Tache::create($request->all());
    return back()->with('success', 'Tâche assignée avec succès !');
}
}
