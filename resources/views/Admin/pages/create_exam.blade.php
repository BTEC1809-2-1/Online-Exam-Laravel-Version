@extends('Admin.layouts.admin')
@section('pagename')
    Create new exam
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <style>
        .form-content
        {
            background:#ebfdff;
        }
    </style>
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
            <div class="col-md-12">
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
                            <div class="form-content">
                                <div class="row pl-md-4 pt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h3>Exam information</h3>
                                        </div>
                                    </div>
                                </div>
                                {{-- 1 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Semester</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT">Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Subject</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- 2 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Class</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Asign lecture</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- 3 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Duration</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Start time</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- 4 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Number of sets</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Questions per set</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Point ratio</label>
                                            <select name="semester" id="" class="form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT"> Mùa có em</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- 5 --}}
                            </div>
                            <div class="form-content mt-3">
                                <div class="row pl-md-4 pt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h3>Exam extra student(s)</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="search" class="form-control" placeholder="Search for student">
                                        </div>
                                    </div>
                                </div>
                                {{-- 6 --}}
                                <div class="row pl-md-4">
                                    <div class="student-list">

                                    </div>
                                </div>
                            </div>
                             {{-- 7 --}}
                            <div class="row pl-md-4 mt-4">
                                <button type="submit" class="btn create-button btn-block">Create Exam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
