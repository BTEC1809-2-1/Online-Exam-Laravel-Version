@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('td').each(function(){
                if( $(this).text()=="Ready"){
                $(this).css('color', 'blue');
                }
                if( $(this).text()=="On-going"){
                    $(this).css('color', 'green');
                }
                if( $(this).text()=="Ended"){
                    $(this).css('color', 'red');
                }
            });
        });
    </script>
@endsection
@section('pagename')
    Dashboard
@endsection
@section('content')
    @csrf
    <div class="content">
        <div class="row justify-content-center w-100">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        {{ __('Database statistic') }}

                    </div>
                    <div class="card-body">
                        Currently logged in as <b>{{ Auth::user()->name }}</b>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4><b>Exams status</b></h4>
                                <div>
                                    <span class="dashboard-exam-status mr-md-5">Total up-comming exam:</span>
                                    <span class="dashboard-exam-status ml-md-5 mr-md-5">Total on-going exam:</span>
                                    <span class="dashboard-exam-status ml-md-5 mr-md-5">Total completed exam:</span>
                                </div>
                                <hr>
                                <div>
                                    <span class="question-type mr-md-5">Total questions in the database:</span>
                                    <span class="question-type ml-md-5 mr-md-5">Information Technology questions</span>
                                    <span class="question-type ml-md-5 mr-md-5">Bussiness Management questions</span>
                                    <span class="question-type ml-md-5 mr-md-5">Graphic Design questions</span>
                                    <span class="question-type ml-md-5 mr-md-5">English questions</span>
                                </div>
                                <hr>
                                <div>
                                    <h4><b>Number of questions by subjects and types:</b></h4>
                                    <div class="row">
                                        <div class="col border-left border-right">
                                            <h5><b>Information Technology</b></h5>
                                            <div>
                                                <b>True False: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard: <b>0</b></span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Mutilple Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Single Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col border-left border-right">
                                            <h5><b>Bussiness Management</b></h5>
                                            <div>
                                                <b>True False: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard: <b>0</b></span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Mutilple Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Single Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col border-left border-right">
                                            <h5><b>Graphic Design</b></h5>
                                            <div>
                                                <b>True False: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard: <b>0</b></span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Mutilple Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Single Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col border-left border-right">
                                            <h5><b>English</b></h5>
                                            <div>
                                                <b>True False: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard: <b>0</b></span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Mutilple Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div>
                                                <b>Single Choice 4: </b>
                                                <div>
                                                    <span class="">Normal:</span>
                                                    <span class="ml-md-2">Medium:</span>
                                                    <span class="ml-md-2">Hard:</span>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Up-coming exams
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end mb-3 px-5">
                            <a href="Exam/Create"><button type="button" class="btn btn-primary mx-2">Create New Exam</button></a>
                            <a href="Exam/List"><button type="button" class="btn btn-primary mx-2">View All Exams</button></a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Start At</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col colspan-3" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listExam as $exam)
                                <tr>
                                    <th>{{$exam->id}}</th>
                                    <td>{{array_search($exam->subject, config('app.subject'))}}</td>
                                    <td>{{array_search($exam->semester, config('app.semester'))}}</td>
                                    <td>{{$exam->classroom}}</td>
                                    <td>{{$exam->start_at}}</td>
                                    <td class="text-center exam-status">{{ array_search($exam->status, config('app.exam_status'))}}</td>
                                    <td class="text-center">
                                        <a href="{{route('get.exam.detail', ['id' => $exam->id])}}" style="text-white" class="btn detail-button">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
