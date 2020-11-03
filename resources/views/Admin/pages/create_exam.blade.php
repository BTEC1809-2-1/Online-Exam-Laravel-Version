@extends('Admin.layouts.admin')
@section('pagename')
    Create new exam
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <style>
        .form-content
        {
            background:#5bc4db;
            border-radius: 20px;    
        }
        .form-group
        {
            color: black;
        }
        .student-list
        {
            min-height: 150px;
            background-color: white;
            border-radius: 10px;
            overflow-y: scroll;
            color: black;
            padding-left: 10px;
        }
        .resultList 
        {
            overflow-y: scroll;
            max-height: 100px;
            width: 100%;
        }
        li, a
        {
            color: black;
        }
        input 
        {
            padding: 4px;
        }
        label
        {
            font-weight: bold;
        }
        .extra-student 
        {
            margin-top: 10px;
            margin-left: 1em;
            padding-left: 10px;
            background:#5bc4db;
            border-radius: 10px;
            max-width: 95%;
        }
        .remove-btn
        {
            background: red;
            color: white;
            height:  30px;
            width: 100px;
            border-radius: 15px;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function()
        {
            $('#examManagement').show();
            $('#examCreate').css({'background-color': 'pink', 'border-radius':'5px'});

            $('#search').keyup(function()
            { 
                var query = $(this).val(); 
                console.log(query);
                if(query != '') 
                {
                    var _token = $('input[name="_token"]').val(); 
                    $.ajax({
                        url:"{{ route('student.search') }}", 
                        method:"POST", 
                        data:
                        {
                            query:query, _token:_token
                        },
                        success:function(data)
                        { 
                            $('#resultList').fadeIn();
                            $('#resultList').css({'background-color':'white'});  
                            $('#resultList').html(data); 
                        }
                    });
                } else
                {
                    $('#resultList').fadeOut();  
                }
            });
            var i = 1;
            $(document).on('click', 'li', function(){  
                $('#studentList').append('<div class="row extra-student justify-content-between my-1 py-1" id="student'+ i +'">'+ $(this).text() + '<button type="button" class="btn my-1 mr-3 remove-btn" onclick="$(this).parent().remove();">Remove</button>'+'</div>');  
                $('#resultList').hide();  
                i++;
            });  
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
                                            <hr>
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
                                                <option value="IT">information Technology</option>
                                                <option value="BM">Bussiness Management</option>
                                                <option value="DS">Designing</option>
                                                <option value="EN">English</option>
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
                                                <option value="BHAF1809-2.1">BHAF1809-2.1</option>
                                                <option value="BHAF1809-2.2">BHAF1809-2.2</option>
                                                <option value="BHAF1903-1.1">BHAF1903-1.1</option>
                                                <option value="BHAF1909-1.2">BHAF1909-1.2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Assign lecture</label>
                                            <select name="lecture" id="" class="form-control">
                                                <option selected></option>
                                                <option value="Bui Duy Linh">Bui Duy Linh</option>
                                                <option value="Nguyen Thai Cuong">Nguyen Thai Cuong</option>
                                                <option value="Nguyen Van Thuan">Nguyen Van Thuan</option>
                                                <option value="Truong Cong Doan">Truong Cong Doan</option>
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
                                                <option value="00:15:00">15 minutes</option>
                                                <option value="00:45:00">45 minutes</option>
                                                <option value="01:30:00">90 minutes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Start Date</label>
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Start Time</label>
                                            <input type="time" class="form-control" name="startTime">
                                        </div>
                                    </div>
                                </div>
                                {{-- 4 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Number of sets</label>
                                            <select name="number_of_set" id="" class="form-control">
                                                <option selected></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Questions per set</label>
                                            <select name="question_per_set" id="" class="form-control">
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
                                            <label for="">Point ratio</label>
                                            <select name="point_ratio" id="" class="form-control">
                                                <option selected></option>
                                                <option value="1">Easy: 40% - Medium: 40% - Hard: 20%</option>
                                                <option value="2">Easy: 50% - Medium: 40% - Hard: 10%</option>
                                                <option value="3">Easy: 50% - Medium: 30% - Hard: 20%</option>
                                                <option value="4">Easy: 60% - Medium: 30% - Hard: 10%</option>
                                                <option value="5">Easy: 70% - Medium: 30% - Hard: 0%</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 5 --}}
                            <div class="form-content mt-3">
                                <div class="row pl-md-4 pt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h3>Exam extra student(s)</h3>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="search" id="search" class="form-control" placeholder="Search for student">
                                            <div id="resultList" class="resultList p-1"></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- 6 --}}
                                <div class="row pl-md-4 pb-md-4">
                                    <div class="col-md-12">
                                        <div class="student-list p-2" id="studentList">

                                        </div>
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
