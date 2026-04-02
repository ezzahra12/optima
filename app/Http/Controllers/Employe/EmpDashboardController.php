<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\Request;

class EmpDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

      $totalTaches = Tache::where('user_id', $user->id)->count();

    $tachesTerminees = Tache::where('user_id', $user->id)
        ->where('statut', 'termine')
        ->count();

    $tachesEnCours = Tache::where('user_id', $user->id)
        ->where('statut', 'en_cours')
        ->count();

   $recentTaches = Tache::where('user_id', auth()->id())
    ->with(['projet.departement'])
    ->latest()
    ->take(5)
    ->get();

    return view('employe.dashboard', compact(
        'totalTaches',
        'tachesTerminees',
        'tachesEnCours',
        'recentTaches'
    ));
}
}
