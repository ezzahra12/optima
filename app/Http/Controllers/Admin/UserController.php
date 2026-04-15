<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class UserController extends Controller
{
   public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

   public function updateFull(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:user,employe,chef_projet,rh,comptable,admin',
            'salaire' => 'nullable|numeric|min:0',
        ]);

        $user->update([
            'role' => $request->role,
            'salaire' => $request->salaire,
        ]);

        return back()->with('success', "Le profil de {$user->prenom} a été mis à jour.");
    }
}
