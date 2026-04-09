<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
 
    public function index()
    {
        $absences = Absence::with('user')->latest()->get();
        return view('rh.absences.index', compact('absences'));
    }

    public function updateStatus(Request $request, Absence $absence)
    {
        $request->validate([
            'statut' => 'required|in:valide,refuse'
        ]);

        $absence->update([
            'statut' => $request->statut
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}
