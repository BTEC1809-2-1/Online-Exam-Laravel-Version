<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BTEC Online Exam</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            @include('Admin.layouts.sidebar')
        </div>
        <div class="content">
            <div class="header border border-black">
                <div class="app-name">
                    @if (\Route::current()->getName() == 'dashboard')
                        Home
                    @else
                        @yield('pagename')
                    @endif
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    @yield('script')
    <script>
        $(document).ready(()=>{
            let toggleExamManagementClicked = false; let toggleQuestionManagementClicked = false;
            $('#toggleExamManagement').on('click', function(){
                toggleExamManagementClicked  = !toggleExamManagementClicked;
                if(toggleExamManagementClicked){
                    $(this).css({'background-color':'#f58742','border-radius':'15px'});
                } else {
                    $(this).css({'background-color':'white','border-radius':'15px'});
                }

            });
            $('#toggleQuestionManagement').on('click', function(){
                toggleQuestionManagementClicked  = !toggleQuestionManagementClicked;
                if(toggleQuestionManagementClicked){
                    $(this).css({'background-color':'#f58742','border-radius':'15px'});
                } else {
                    $(this).css({'background-color':'white','border-radius':'15px'});
                }

            });
        });
    </script>
</body>
</html>
