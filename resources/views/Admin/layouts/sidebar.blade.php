<div class="sidebar">
    <nav class="sidebar">
        <div class="btn-home">
            <a href="{{route('admin')}}" class="bg-white"><img src="{{asset('image/bteclogo.png')}}" alt="" id="logo"></a>
        </div>
        <ul class="list-unstyled components">
            <li class="active text-center">
                <a href="#examManagement" id="toggleExamManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle w-100 navigate-header" style="padding: 0.1em 1em">
                    Exam management
                </a>
                <ul class="collapse list-unstyled" id="examManagement">
                    <li id="examCreate" class="text-center navigate-link">
                        <a href="{{route('create.exam')}}" class="nlink"  id="create-exam">Create new Exam</a>
                    </li>
                    <li id="examList" class="text-center navigate-link">
                        <a href="{{route('get.exam.list')}}" class="nlink">List all exam</a>
                    </li>
                    <li id="examList" class="text-center navigate-link">
                        <a href="{{route('get.exam.list')}}" class="nlink">View Student Result</a>
                    </li>
                </ul>
            </li>
            <li class="text-center">
                <hr>
                <a href="#questionManagement" id="toggleQuestionManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle navigate-header" style="padding: 0.1em 0.3em">
                    <i class="fas fa-copy"></i>
                    Question Management
                </a>
                <ul class="collapse list-unstyled" id="questionManagement">
                    <li id="questionCreate" class="text-center navigate-link">
                        <a href="{{route('create.question')}}" class="nlink">Create new question</a>
                    </li>
                    <li id="questionList" class="text-center navigate-link">
                        <a href="{{route('get.question.list')}}" class="nlink">List all question</a>
                    </li>
                </ul>
            </li>
            <hr>
            <a class="w-100" href="{{route('logout')}}">
                <li class="text-center logout">
                    Logout
                </li>
            </a>
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
    .navigate-link:hover {
        background-color: #6cb2eb;
        border-radius: 15px;
    }
    .navigate-header:hover {
        background-color: #f58742;
        border-radius: 15px;
    }
</style>

