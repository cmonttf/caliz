<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function edit($id){
        $user = User::find($id);
        return view('profile.editar', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();
        }
        return view('profile.index')->with('success', 'Se ha actualizado satisfactoriamente');
    }
}
