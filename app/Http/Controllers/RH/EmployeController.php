<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeController extends Controller
{
    public function index()
    {

        $employes = User::where('role', '!=', 'admin')->latest()->get();

        return view('rh.employes.index', compact('employes'));
    }
}
