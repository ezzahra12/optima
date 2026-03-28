<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
   public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // تبديل الـ Role (مثلاً نرجعوه Admin)
    public function updateRole(Request $request, User $user)
    {
        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'Role mis à jour !');
    }
}
