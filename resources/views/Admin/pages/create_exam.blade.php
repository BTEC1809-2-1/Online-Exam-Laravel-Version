@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('content')
    //TODO: Change button color to pink
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create New Exam
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('exam.store')}}">
                            @csrf
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <select name="subject" id="" class="form-control">
                                        <option selected></option>
                                        <option value="IT">Mon thay Linh day</option>
                                        <option value="BM">Mon co Em</option>
                                        <option value="DS">Mon gi day?</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Semester</label>
                                    <select name="semester" id="" class="form-control">
                                        <option selected></option>
                                        <option value="SPR">Spring</option>
                                        <option value="SUM">Summer</option>
                                        <option value="AUT"> Mùa có em</option>
                                        <option value="WIN">Winnter</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Classroom</label>
                                    <input type="text" class="form-control" name="classroom">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="">Duration</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="duration">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Minutes</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" name="date">
                                    </div>
                                    <div class="form-group col">
                                        <label for="">Start Time</label>
                                        <input type="time" class="form-control" name="startTime">
                                    </div>
                                </div>
                            <button type="submit" class="btn create-button btn-block">Create Exam</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function(){
                $('#homeSubmenu').show();
                $('#create-exam').css('background', 'mau-hann-thich-header');
            });
        </script>
    @endsection
@endsection
