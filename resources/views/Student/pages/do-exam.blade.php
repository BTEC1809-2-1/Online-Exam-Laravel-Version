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
        ul{
            list-style-type: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-3">
                                <div class="row p-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Exam ID</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
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
                                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <a href="" class="btn create-button btn-block">Submit</a>
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
                                    <div class="card-body px-5">
                                        <div class="row justify-content-around">
                                            <div class="col-8 border border-dark p-3">
                                                <ul>
                                                    <li>A1</li>
                                                    <li>A2</li>
                                                    <li>A3</li>
                                                    <li>A4</li>
                                                </ul>
                                            </div>
                                            <div class="col-3 border border-dark">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
