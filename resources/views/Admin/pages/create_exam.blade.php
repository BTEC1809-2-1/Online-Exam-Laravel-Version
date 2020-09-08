@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        Create New Exam
                    </div>

                    <div class="card-body">
                        <form>
                            @csrf
                            <form>
                                <div class="form-group">
                                    <label for="">Exam ID</label>
                                <input type="text" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label for="">Semester</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Classroom</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select class="form-control">
                                                <option>Up-coming</option>
                                                <option>On-going</option>
                                                <option>Completed</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Duration</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Minutes</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">

                                        <div class="form-group">
                                            <label for="">Start Date</label>
                                            <input type="date" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Start Time</label>
                                            <input type="time" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            <button type="submit" class="btn btn-success btn-block">Create Exam</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
