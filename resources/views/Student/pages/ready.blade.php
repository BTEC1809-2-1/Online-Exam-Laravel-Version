@extends('Student.layouts.student')
@section('title')
  <title>Yeu Thu Hang Nhat Tren Doi</title>
@endsection
@section('style')

@endsection
@section('content')
  <div class="container p-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                Exam Name
            </div>
            <div class="card-body px-5">
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">Subject</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="row ">
                    <div class="col pl-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Duration</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Count Down</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('do.exam.page')}}" class="btn btn-block create-button">Start</a>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
