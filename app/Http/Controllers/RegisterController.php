<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class RegisterController extends Controller
{
    protected $email;
    protected $name;

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

        $this->email = $request->get('email');
        $this->name = $request->get('name');

        $this->sendRegisterEmail();

        return redirect()->route('auth.login');
        //User::create(Input::all());
        //User::create($request->all());

    }


    public function sendRegisterEmail() {

        $emailData = new \stdClass();

        $emailData->email = $this->email;
        $emailData->name = $this->name;
        $emailData->subject = "Welcome user " . $this->name;
        $emailData->footer = "footer here";
        $emailData->header = "header here";

        //$data['name'] = "Pepito";
        $data['name'] = $this->name;
        $data['var2'] = "valor2";

        \Mail::queue('emails.message', $data, function($message)
                                                use ($emailData) {
            $message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));
            $message->to($emailData->email, $emailData->name);
            $message->subject($emailData->subject);
        });
    }
}
