@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/toggleEditUpdate.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        Exam Detail
                    </div>

                    <div class="card-body">
                        <form id="form">
                            <div class="form-row">
                                <div class="col">

                                    <div class="form-group">
                                        <label for="">Exam ID</label>
                                    <input type="text" class="form-control" value="{{$exam->id}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Semester</label>
                                        <input type="text" class="form-control"  value="{{$exam->semester}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Classroom</label>
                                        <input type="text" class="form-control"  value="{{$exam->classroom}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Start At</label>
                                        <input type="text" class="form-control" value="{{$exam->start_at}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Duration</label>
                                        <input type="text" class="form-control" value="{{$exam->duration}}" readonly>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="text" class="form-control" value="{{$exam->status}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Created at</label>
                                        <input type="text" class="form-control" value="{{$exam->created_at}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Creted by</label>
                                        <input type="text" class="form-control" value="{{$exam->created_by}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Updated at</label>
                                        <input type="text" class="form-control" value="{{$exam->updated_at}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Updated by</label>
                                        <input type="text" class="form-control" value="{{$exam->updated_by}}" readonly>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <button id="edit" type="submit" class="btn btn-success btn-block">Edit</button>
                                <button type="submit" class="btn btn-danger btn-block">Delete this Exam</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
