<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Hash;
use Illuminate\Http\Request;

use App\User;

/**
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request) {
        //dd($request->all());
        //\Debugbar::info("Ok entra a postLogin");
        //echo "asdasd";

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($this->login($request->email,$request->password)) {
            //REDIRECT TO HOME
            return redirect()->route('auth.home');
        } else {
            //REDIRECT BACK
            $request->session()->flash('login_error',
                'Login incorrecte');
            //Session::flash()
            return redirect()->route('auth.login');
        }
    }

    /**
     * Login
     * @param $email
     * @param $password
     * @return bool
     */
    private function login($email, $password)
    {
        //TODO: Mirar bé a la base de dades

        //$user = User::findOrFail(id);
        //$user = User::all();
        $user = User::where('email',$email)->first();

        if ($user == null) {
            return false;
        }

        if (Hash::check($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get Login
     * @return \Illuminate\View\View
     */
    public function getLogin() {
        return view('login');
    }


}
