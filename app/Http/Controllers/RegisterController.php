<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class RegisterController extends Controller
{
    public function getRegister()
    {
        //echo "Aqui va el registre";
        return view('register');
    }

    public function postRegister(Request $request)
    {
        //dd(Input::all());

        $this->validate($request, [
            'name' => 'required|max:100',
            'email' =>
                'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->password = bcrypt(
            $request->get('password'));
        $user->email = $request->get('email');
        $user->save();

        return redirect()->route('auth.login');
        //User::create(Input::all());
        //User::create($request->all());

    }
}
