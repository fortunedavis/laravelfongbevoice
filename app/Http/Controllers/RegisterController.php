<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $user =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $role = Role::findByName($request["role"]);
        $user->assignRole($role);

        $users =  User::all();
        
        return redirect()->route('admin.users', ['users' => $users])
    ->with('success', 'User registered successfully');

    }
}
