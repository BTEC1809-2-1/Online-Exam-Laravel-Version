@extends('Admin.layouts.admin')
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
                    Question list
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <button type="button" class="btn btn-primary mx-2">Create New Exam</button>
                        <button type="button" class="btn btn-primary mx-2">View All Exams</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Question</th>
                                <th scope="col">Type</th>
                                <th scope="col">Subject</th>
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

                                <button type="button" class="btn btn-success">
                                    <a href="{{route('get.question.detail',
                                                ['id' => $question->id])}}">
                                        View detail
                                    </a>
                                </button>

                                <button type="button" class="btn btn-info">
                                    <a href="{{route('get.question.detail',
                                            ['id' => $question->id])}}">
                                            Edit
                                    </a>
                                </button>

                                <button type="button" class="btn btn-danger">
                                    <a href="{{route('get.question.detail',
                                    ['id' => $question->id])}}">
                                        Delete
                                    </a>
                                </button>

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
