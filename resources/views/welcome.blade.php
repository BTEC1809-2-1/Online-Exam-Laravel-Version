<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BTEC online exam</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("{{url('image/everglowtn.jpg')}}");
                background-repeat: no-repeat;
                background-size: cover;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if ( Auth::user()->role == config('app.role.admin'))
                            <a href="{{ url('/admin') }}">Home</a>
                        @else
                            <a href="{{ url('/logout') }}">Logout</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="logo" >
                    <img src="{{ asset('/image/bteclogo.png') }}" alt="">
                </div>
                <div class="title m-b-md">
                    Welcome to the Online Exam site
                    <br>
                    @if (Auth::check())
                        @if (!(Auth::user()->role == config('app.role.admin')))
                            You are currently not having any exam.
                        @endif
                    @endif
                </div>

                <div class="links">
                    <a href="http://cms.btec.edu.vn/">BTEC CMS</a>
                    <a href="http://ap.btec.edu.vn/">BTEC AP</a>
                    <a href="https://www.facebook.com/fptbtec/">BTEC Fanpage</a>
                    <a href="https://www.facebook.com/btec.fpt.edu.vn">BTEC Confession</a>
                    <a href="https://btec.fpt.edu.vn/">BTEC Website</a>
                </div>
            </div>
        </div>
    </body>
</html>
