@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('content')
<div class="container" style="background-image:url({{url('/images/myimage.jpg')}})">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}

                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    Welcome home <b>{{ Auth::user()->name }}</b>

                </div>
            </div>
           <div class="card">
                <div class="card-header">
                    Up-coming exams
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <a href="{{route('create.exam')}}"><button type="button" class="btn btn-primary mx-2">Create New Exam</button></a>
                        <a href="{{route('get.exam.list')}}"><button type="button" class="btn btn-primary mx-2">View All Exams</button></a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Class</th>
                                <th scope="col">Start At</th>
                                <th scope="col">Status</th>
                                <th scope="col colspan-3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listExam as $exam)
                            <tr>
                                <th>{{$exam->id}}</th>
                                <td>{{$exam->semester}}</td>
                                <td>{{$exam->classroom}}</td>
                                <td>{{$exam->start_at}}</td>
                                <td>{{$exam->status}}</td>
                                <td>
                                    <a href="{{route('get.exam.detail', ['id' => $exam->id])}}"><button type=button" class="btn btn-success">View detail</button></a>
                                    <a href="{{route('get.exam.detail', ['id' => $exam->id])}}"><button type=button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
           <div class="card">
                <div class="card-header">
                    Recently added question
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <a href="{{route('get.question.list')}}"><button type="button" class="btn btn-primary mx-2">View All Question</button></a>
                        <a href="{{route('create.question')}}"><button type="button" class="btn btn-primary mx-2">Create New question</button></a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Start At</th>
                                <th scope="col">Status</th>
                                <th scope="col colspan-3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listQuestion as $question)
                            <tr>
                                <th>{{$question->id}}</th>
                                <td>{{$question->question}}</td>
                                <td>{{$question->type}}</td>
                                <td>{{$question->subject}}</td>
                                <td>
                                <a href="{{route('get.question.detail', ['id' => $question->id])}}"><button type="button" class="btn btn-success">View detail</button></a>
                                    <a href="{{route('get.question.detail', ['id' => $question->id])}}"><button type="button" class="btn btn-danger">Delete</button></a>
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
@endsection
