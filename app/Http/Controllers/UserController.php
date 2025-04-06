<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;



class UserController extends Controller
{
    protected function checkAdmin()
    {
        if (Gate::denies('admin')) {
            redirect()->route('access.denied')->send();
        }
    }

    public function getAllUsers(Request $request)
    {
        $this->checkAdmin();
        $query = User::query();

        if ($request->filled('id')) {
            $query->where('id', $request->input('id'));
        }
    
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
    
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->input('month'));
        }
        
        $users = $query->paginate(10);
        return view('useraccount', compact('users'));
    }
}