<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
class SalaireController extends Controller
{
    public function index()
    {
        $mesSalaires = Paiement::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employe.salaires.index', compact('mesSalaires'));
    }
}
