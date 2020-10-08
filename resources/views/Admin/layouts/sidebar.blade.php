<div class="sidebar">
    <nav class="sidebar">
        <div class="btn-home border border-top-black border-bottom-black">
            <a href="{{route('dashboard')}}" class="bg-white"><img src="{{asset('image/bteclogo.png')}}" alt="" id="logo"></a>
        </div>
        <ul class="list-unstyled components">
            <li class="active text-center">
                <a href="#examManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    Exam management
                </a>
                <ul class="collapse list-unstyled" id="examManagement">
                    <li id="examCreate" class="text-center">
                        <a href="{{route('create.exam')}}" class="nlink"  id="create-exam">Create new Exam</a>
                    </li>
                    <li id="examList" class="text-center">
                        <a href="{{route('get.exam.list')}}" class="nlink">List all exam</a>
                    </li>
                </ul>
            </li>
            <li class="text-center">
                <hr>
                <a href="#questionManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i>
                    Question Management
                </a>
                <ul class="collapse list-unstyled" id="questionManagement">
                    <li id="questionCreate" class="text-center">
                        <a href="{{route('create.question')}}" class="nlink">Create new question</a>
                    </li>
                    <li id="questionList" class="text-center">
                        <a href="{{route('get.question.list')}}" class="nlink">List all question</a>
                    </li>
                </ul>
            </li>
            <hr>
            <li class="text-center logout">
                <a href="{{route('logout')}}">Logout</a>
            </li>
        </ul>
    </nav>
</div>
<style>
    .btn-home {
        max-width: 290px;
        min-height: 100px;
        background: white;
    }
    .logout {
        background-color: none;
    }
    .logout:hover {
        background-color: red;
        border-radius: 15px;
    }
    a:hover {
        text-decoration: none;
    }
    #logo
    {
        max-width: 150px;
    }
    .nav-link
    {
        font-size: 16px;
    }
</style>

