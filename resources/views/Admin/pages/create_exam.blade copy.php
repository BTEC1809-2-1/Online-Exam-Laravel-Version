@extends('Admin.layouts.admin')
@section('pagename')
    Create new exam
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#examManagement').show();
        $('#examCreate').css({'background-color': 'pink', 'border-radius':'5px'});
    });
</script>
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create New Exam
                        @if (\Session::has('error'))
                            <div class="">
                                <ul>
                                    <li>{!! \Session::get('error') !!}</li>
                                </ul>
                            </div>
                        @endif
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
                                    <label for="">Asign lecture</label>
                                    <select name="lecture" id="" class="form-control">
                                        <option selected></option>
                                        <option value="Admin1">Amin 1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Classroom</label>
                                    <select name="classroom" id="" class="form-control">
                                        <option selected></option>
                                        <option value="BHAF">BHAF</option>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="">Duration</label>
                                        <div class="input-group">
                                            <select name="duration" id="" class="form-control">
                                                <option selected></option>
                                                <option value="00:15:00">15</option>
                                                <option value="00:45:00">45</option>
                                                <option value="01:30:00">90</option>
                                            </select>
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
@endsection