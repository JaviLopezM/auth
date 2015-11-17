<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">LOGIN</div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('login_error'))
                    <div class="alert alert-danger">
                        <ul>
                           {{ Session::get('login_error') }}
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('auth.postLogin') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="email" name="password" required>
                    </div>
                    <div class="checkbox">
                        <label><input name="remember" type="checkbox"> Remember me</label>
                    </div>
                    <button id="login" type="submit" class="btn btn-default">Login</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>

                No ets usuari encara?
                <a id="register" href="{{ route('register.register') }}">Registra't</a>
            </div>
        </div>
    </body>
</html>
