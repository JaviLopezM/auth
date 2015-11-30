<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Auth;
use Hash;
use Illuminate\Http\Request;

use App\User;
use Session;

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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->route('auth.home');
            //return redirect()->intended('dashboard');
        } else {
            return redirect()->route('auth.login');
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
