<div class="sidebar">
    <nav class="sidebar">
        <ul class="list-unstyled components">
            <div class="btn-home">
                <a href="#">Home</a>
            </div>
            <hr>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    Exam management
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="{{route('create.exam')}}">Create new Exam</a>
                    </li>
                    <li>
                        <a href="{{route('get.exam.list')}}">List all exam</a>
                    </li>
                </ul>
            </li>
            <li>
                <hr>
                <a href="#questionManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i>
                    Question Management
                </a>
                <ul class="collapse list-unstyled" id="questionManagement">
                    <li>
                        <a href="{{route('create.question')}}">Create new question</a>
                    </li>
                    <li>
                        <a href="{{route('get.question.list')}}">List all question</a>
                    </li>
                </ul>
            </li>
            <hr>
                <a href="{{route('logout')}}">Logout</a>
        </ul>
        <div class="trademark mt-auto">
            @Copyright BinhAn 2020
        </div>
    </nav>
</div>

