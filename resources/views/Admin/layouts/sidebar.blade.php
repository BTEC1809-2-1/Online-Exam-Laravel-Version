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
            {{-- <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-copy"></i>
                Student management
            </a>
            {{-- Do I even need this? Let's just leave it here, just in case we need it later--}}
            {{-- <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
            </ul> --}}
            </li>
        </ul>
        <div class="trademark mt-auto">
            @Copyright BinhAn 2020
        </div>
    </nav>
</div>

