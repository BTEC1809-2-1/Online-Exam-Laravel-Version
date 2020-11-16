@extends('Student.layouts.student')
@section('title')
  <title>Yeu Thu Hang Nhat Tren Doi</title>
@endsection
@section('style')
    <style>
        input[readonly]
        {
            background: white;
        }
    </style>
@endsection
@section('script')
    <script>

    </script>
@endsection
@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <div class="row justify-content-center">
                        <h3 class="m-0">Exam completed</h3>
                    </div>
                </div>
                <div class="card-body px-5">
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value={{$studentID}} readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Exam ID</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$examID}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-0 pr-md-1">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Correct answer</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$result['correct_answers']}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 p-0 pl-md-1">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Wrong answer</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$result['wrong_answers']}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Score</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$result['score']}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row justify-content-center">
                        The exam has completed, you can close this window.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
