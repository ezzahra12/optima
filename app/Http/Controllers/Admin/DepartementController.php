<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departement;

class DepartementController extends Controller
{
    public function index() {
        $departements = Departement::all();
        return view('admin.departements.index', compact('departements'));
    }

    public function store(Request $request) {
        $request->validate(
                [
                    'nom' => 'required'
                ]
            );
        Departement::create($request->all());
        return back()->with('success', 'Département ajouté !');
    }

    public function destroy(Departement $departement) {
        $departement->delete();
        return back()->with('success', 'Département supprimé !');
    }
}
