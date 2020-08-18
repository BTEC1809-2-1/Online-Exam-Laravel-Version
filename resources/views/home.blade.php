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

                    Welcome home <b>{{ Auth::user()->name }}</b>

                </div>
            </div>
           <div class="card">
                <div class="card-header">
                    Up-coming exams
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                    <button type="button" class="btn btn-primary mx-2"><a href="{{route('create.exam')}}">Create New Exam</a></button>
                        <button type="button" class="btn btn-primary mx-2"><a href="{{route('get.exam.list')}}">View All Exams</a></button>
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
                                    <button type=button" class="btn btn-success"><a href="{{route('get.exam.detail', ['id' => $exam->id])}}">View detail</a></button>
                                    <button type=button" class="btn btn-danger"><a href="{{route('get.exam.detail', ['id' => $exam->id])}}">Delete</a></button>
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
                        <button type="button" class="btn btn-primary mx-2"><a href="{{route('create.question')}}">Create New question</a></button>
                        <button type="button" class="btn btn-primary mx-2"><a href="{{route('get.question.list')}}">View All Question</a></button>
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
                                <button type="button" class="btn btn-success"><a href="{{route('get.question.detail', ['id' => $question->id])}}">View detail</a></button>
                                    <button type="button" class="btn btn-danger"><a href="{{route('get.question.detail', ['id' => $question->id])}}">Delete</a></button>
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
