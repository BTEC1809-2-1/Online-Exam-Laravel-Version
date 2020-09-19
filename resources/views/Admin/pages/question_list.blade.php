@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
@endsection
@section('content')
<div class="container" style="background-image:url({{url('/images/myimage.jpg')}})">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                    @endif
                    <div class="row text-center justify-content-between">
                        <b class="my-auto ml-md-5">{{ Auth::user()->name }}</b>
                        <nav class="navbar navbar-light justify-content-between">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2 w-80" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-search my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Question list
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <a href="{{route('create.question')}}">
                            <button type="button" class="btn question-create mx-5">Create New question</button>
                        </a>
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
                                <td class="text-right">
                                    <button type="button" class="btn question-edit">
                                        <a href="{{route('get.question.detail',
                                                    ['id' => $question->id])}}">
                                            View detail
                                        </a>
                                    </button>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        Delete this question
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center pagination">
                        {{$listQuestion->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
