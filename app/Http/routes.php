<?php

Route::get('/login',
    ['as' => 'auth.login',
     'uses' => 'LoginController@getLogin'
    ]);
Route::post('/postLogin', [
    'as' => 'auth.postLogin',
    'uses' => 'LoginController@postLogin']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', ['as' => 'auth.home', function () { return view('home'); }]);

Route::get('/resource', function () {
    $authenticated = false;
    if (Session::has('authenticated')) {
        if (Session::get('authenticated') == true ) {
            $authenticated = true;
        }
    }

    if ($authenticated) {
        return view('resource');
    } else {
        return redirect()->route('auth.login');
    }

});

Route::get('/flushSession',
    ['as' => 'session.flush',
     function() {
            Session::flush();
    }]
);

Route::get('/register',
    ['as' => 'register.register',
        'uses' => 'RegisterController@getRegister']
);

Route::post('/register',
    ['as' => 'register.postRegister',
        'uses' => 'RegisterController@postRegister']
);
