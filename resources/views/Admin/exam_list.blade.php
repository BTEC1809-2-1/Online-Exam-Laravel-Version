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
                    Exam list
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
                                    <button type=button" class="btn btn-success"><a href="Exam/Detail/{{$exam->id}}">View detail</a></button>
                                    <button type=button" class="btn btn-info"><a href="Exam/Edit/{{$exam->id}}">Edit</a></button>
                                    <button type=button" class="btn btn-danger"><a href="Exam/Delete/{{$exam->id}}">Delete</a></button>
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
