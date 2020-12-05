@extends('Admin.layouts.admin')
@section('pagename')
Question List
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
    <style>
        .question-search-bar {
            min-width: 250px;
            max-width: 500px;
        }
    </style>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#questionManagement').show();
        $('#questionList').css({'background-color':'pink', 'border-radius':'5px'});
    });
</script>
@endsection
@section('content')
    <div class="admin-content-body">
        @csrf
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-12">
                @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            <div class="card question-list">
                <div class="card-header">
                    Question list
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <div class="col-md-8">
                            <form class="form">
                                @csrf
                                <div class="row justify-content-end">
                                    <input class="form-control mr-1 question-search-bar" type="search" placeholder="Search" aria-label="Search" id="search">
                                    <button class="btn search-button my-2 my-sm-0" type="submit">Search</button>
                                    <div class="questionList"></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{route('create.question')}}" class="btn detail-button mx-5">
                                Create New question
                            </a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Question</th>
                                <th scope="col" class="text-center">Level of difficult</th>
                                <th scope="col" class="text-center">Subject</th>
                                <th scope="col colspan-3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listQuestion as $question)
                                @if (\Session::has('qID') and ($question->id ==  \Session::get('qID')))
                                <tr style="background: #DCF1DC; border-radius">
                                    <th>{{$question->id}}</th>
                                    <td>{{substr($question->question, 0, 120)}}...</td>
                                    <td class="text-center">{{array_search($question->level_of_difficult, config('app.question_level_of_difficult'))}}</td>
                                    <td class="text-center">{{$question->subject}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-block detail-button" style="color:white;" href="{{route('get.question.detail', ['id' => $question->id])}}">
                                            View detail
                                        </a>
                                    </td>
                                </tr>
                                @else
                                    <tr>
                                        <th>{{$question->id}}</th>
                                        <td>{{substr($question->question, 0, 150)}}...</td>
                                        <td class="text-center">{{array_search($question->level_of_difficult, config('app.question_level_of_difficult'))}}</td>
                                        <td class="text-center">{{$question->type}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-block detail-button" style="color:white;" href="{{route('get.question.detail', ['id' => $question->id])}}">
                                                View detail
                                            </a>
                                        </td>
                                    </tr>
                                @endif
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
@endsection
