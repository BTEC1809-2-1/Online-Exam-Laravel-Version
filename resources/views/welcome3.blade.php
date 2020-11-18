<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Thang dev bi dien roi</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
        }

        .page {
            witdh: 100vh;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F1F1F1;
        }

        .card {
            width: 960px;
            height: 540px;
            background-color: white;
            box-shadow: 0px 50px 100px rgba(0, 0, 0, .4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            height: 100%;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .menu {
            width: 100%;
            height: 10%;
        }

        .menu h3 {
            font-size: 1em;
            margin-left: 25px;
        font-weight: 800;
        float: left;
        }

        i {
        float: right;
        font-size: 0.8em;
        margin: 20px 25px;
        transition: font-size 0.2s;
        }

        i:hover {
            font-size: 1em;
        }

        .content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content .text {
            margin-bottom: 50px;
        }

        .text h1 {
            font-size: 2.5em;
            line-height: 1;
        }

        .text p {
            color: rgb(0,0,0,0.5);
            margin-bottom: 40px;
            margin-top: -5px;
        }

        .text a {
            font-weight: 600;
            color: white;
            text-decoration: none;
            background: #EF4135;
            transition: background-color 0.2s;
            transition: color 0.2s;
            padding: 10px 20px;
            border-radius: 0%;
        }

        .text a:hover, .text a:active {
            background-color: white;
            color: #EF4135;
        }

        .photo {
            height: 50%;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url("https://cdn.pixabay.com/photo/2017/07/10/08/27/fruit-2489367__340.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="card">
                <div class="container">
                    <div class="menu">
                        <h3>Btec Online Exam System</h3>
                            <i class="fas fa-bars"></i>
                    </div>
                <div class="content">
                    <div class="text">
                        <h1>Bring Yourself<br>To The Top</h1>
                            <p>Stop looking for a secret trick and recognise that <br>the best version of yourself should be your vision <br> and not anybody else’s</p>
                        @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/home') }}">Home</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                @endauth
                        @endif
                    </div>
                </div>
                </div>
                <div class="photo"></div>
            </div>
            </div>
    </body>
</html>
