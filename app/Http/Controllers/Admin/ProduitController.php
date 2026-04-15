<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produit;
class ProduitController extends Controller
{
    public function index() {
        $produits = Produit::all();
        return view('admin.produits.index', compact('produits'));
    }
    public function store(Request $request) {
        Produit::create($request->all());
        return back()->with('success', 'Produit ajouté !');
    }
}
