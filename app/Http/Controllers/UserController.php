<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use function PHPUnit\Framework\isEmpty;

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

            $p0 = $request->password;
            $p1 = $request->password1;
            $p2 = $request->password2;
            if(!empty($p0)){
                if(bcrypt($p0) == $user->password){
                    if($p1 == $p2){
                        $user->password = bcrypt($p1);
                    }else{
                        return view('profile.editar', compact('user'))->with('alert', 'No coiniciden las nuevas contraseñas.');
                    }
                }else{
                    return view('profile.editar', compact('user'))->with('alert', 'La contraseña actual ingresada no es la correcta.');
                }
            }
            $user->update();
        }
        return view('profile.index')->with('success', 'Se ha actualizado satisfactoriamente.');
    }
}
