@extends('Student.layouts.student')
@section('title')
    <title>Yeu Thu Hang Nhat Tren Doi</title>
@endsection
@section('style')
    <style>
        .do-exam{
            min-height: 500px;
            max-height: 700px;
            overflow-y: scroll;
            overflow-x: auto;
        }
        .question-content
        {
            font-weight: bold;
            font-size: 18px;
        }
        ul{
            list-style-type: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <form action="{{route('submit.exam')}}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-center pt-3">
                                <div class="col-md-3">
                                    <div class="row p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-default">Exam ID</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$exam->id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-default">Time Remaining</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{Auth::user()->id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <button type="submit" class="btn create-button btn-block">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col do-exam pt-2 pl-5">
                                    <div class="card mt-2 mb-2">
                                        <div class="card-header px-5">
                                            <h4>Question</h4>
                                        </div>
                                        @foreach($questions ?? '' as $qIndex=>$question)
                                        <div class="card-body px-5">
                                            <span class="question-content">{{$question['question']}}</span>
                                            <div class="row justify-content-around">
                                                <div class="col-md-11 p-1">
                                                    <ul>
                                                        @foreach ($question['answers'] as $aIndex=>$answer)
                                                            <li><input type="radio" name="answer{{$qIndex+1}}" value="{{$aIndex + 1}}">{{$answer->content}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
