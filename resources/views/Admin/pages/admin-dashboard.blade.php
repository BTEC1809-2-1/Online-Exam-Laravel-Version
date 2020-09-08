@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('content')
    @csrf
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-11">
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
                        <div class="row justify-content-end mb-3 px-5">
                            <a href="/Create"><button type="button" class="btn btn-primary mx-2">Create New Exam</button></a>
                            <a href="/List"><button type="button" class="btn btn-primary mx-2">View All Exams</button></a>
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
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
