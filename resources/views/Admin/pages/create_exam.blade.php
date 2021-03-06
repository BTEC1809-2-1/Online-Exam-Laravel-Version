@extends('Admin.layouts.admin')
@section('pagename')
    Create new exam
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <style>
        body {
            overflow-y: hidden;
        }
        .form-content
        {
            background:##FCFCFC;
            border-radius: 20px;
        }
        .form-group
        {
            color: black;
        }
        .student-list
        {
            min-height: 150px;
            max-height: 200px;
            background-color: white;
            border-radius: 10px;
            overflow-y: scroll;
            color: black;
            padding-left: 10px;
        }
        .resultList
        {
            overflow-y: hidden;
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
            background:#5fb649;
            border-radius: 10px;
            max-width: 95%;
        }
        .student-name {
            padding-top: 10px;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
        .remove-btn
        {
            background: #f06f2b;
            color: white;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .separator {
            background: black;
            height: 2px;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function()
        {
            $('#examManagement').show();
            $('#examCreate').css ({
                'background-color': '#5eb44b',
                'border-radius':'5px',
                'color':'white'});
            $('#search').keyup(function()
            {
                var query = $(this).val();
                if(query != '')
                {
                    var _token = $('input[name="_token"]').val();
                    let classroom = $('#classroom').find(":selected").text();
                    $.ajax({
                        url:"{{ route('student.search') }}",
                        method:"POST",
                        data:
                        {
                            query:query, _token:_token, classroom: classroom
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
            var extraStudent = [];
            $(document).on('click', '.student-id', function(){
                $('#studentList').append(`
                    <div class="row extra-student justify-content-between my-1 py-1" id="student'+ i +'">
                        <span class="student-name">
                            ` + $(this).text() + `
                        </span>
                        <button type="button" class="btn my-1 mr-3 remove-btn" onclick="$(this).parent().remove();">Remove</button>
                     </div>`);
                extraStudent.push($(this).children('.extra-id').val());
                $('#resultList').hide();
                i++;
                $('#search').val(null);
            });
            $('#duration').on('change', function(){
                if(this.value!=null) {
                    switch (this.value) {
                        case '00:15:00':
                            $('#question-per-set').empty();
                            $('#question-per-set').append(`
                                <option selected></option>
                                <option value="10">10 questions</option>
                                <option value="12">12 questions</option>
                                <option value="15">15 questions</option>
                            `);
                            break;
                        case '00:45:00':
                            $('#question-per-set').empty();
                            $('#question-per-set').append(`
                                <option selected></option>
                                <option value="30">30 questions</option>
                                <option value="45">45 questions</option>
                            `);
                            break;
                        case '01:30:00':
                            $('#question-per-set').empty();
                            $('#question-per-set').append(`
                                <option selected></option>
                                <option value="60">60 questions</option>
                                <option value="90">90 questions</option>
                            `);
                            break;
                        default:
                            $('#question-per-set').empty();
                            break;
                    }
                }
            });
            $('#createExam').on('click', function(){
                extraStudent = extraStudent;
                $('#create').append(`<input type="hidden" name="extra_student" value="`+extraStudent+`">`);
                $('#create').submit();
            });
        });
    </script>
@endsection
@section('content')
    <div class="admin-content-body">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        Note: Fields with * mark are required, the others can be leave empty
                        @if (\Session::has('error'))
                            <div class="">
                                <ul>
                                    <li>{!! \Session::get('error') !!}</li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('exam.store')}}" id="create">
                            @csrf
                            <div class="form-content">
                                <div class="row pl-md-4 pt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h3>Exam information</h3>
                                            Fill this form information to automatically create an exam.
                                            <hr class="separator">
                                        </div>
                                    </div>
                                </div>
                                {{-- 1 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Semester *</label>
                                            <select name="semester" id="" class="@error('semester') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="SPR">Spring</option>
                                                <option value="SUM">Summer</option>
                                                <option value="AUT">Autumn</option>
                                                <option value="WIN">Winnter</option>
                                            </select>
                                            @error('semester')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Subject *</label>
                                            <select name="subject" id="" class="@error('subject') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="IT">Information Technology</option>
                                                <option value="BM">Bussiness Management</option>
                                                <option value="DS">Designing</option>
                                                <option value="EN">English</option>
                                            </select>
                                            @error('subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- 2 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Class *</label>
                                            <select name="classroom" id="classroom" class="@error('classroom') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="BHAF1809-2.1">BHAF1809-2.1</option>
                                                <option value="BHAF1809-2.2">BHAF1809-2.2</option>
                                                <option value="BHAF1903-1.1">BHAF1903-1.1</option>
                                                <option value="BHAF1909-1.2">BHAF1909-1.2</option>
                                            </select>
                                            @error('classroom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Assign lecture *</label>
                                            <select name="lecture" id="" class="@error('lecture') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="Bui Duy Linh">Bui Duy Linh</option>
                                                <option value="Nguyen Thai Cuong">Nguyen Thai Cuong</option>
                                                <option value="Nguyen Van Thuan">Nguyen Van Thuan</option>
                                                <option value="Truong Cong Doan">Truong Cong Doan</option>
                                            </select>
                                            @error('lecture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- 3 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Duration *</label>
                                            <select name="duration" id="duration" class="@error('duration') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="00:15:00">15 minutes</option>
                                                <option value="00:45:00">45 minutes</option>
                                                <option value="01:30:00">90 minutes</option>
                                            </select>
                                            @error('duration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Start Date *</label>
                                            <input type="date" class="@error('date') is-invalid @enderror form-control" name="date">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Start Time *</label>
                                            <input type="time" class="@error('time') is-invalid @enderror form-control" name="time">
                                            @error('time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- 4 --}}
                                <div class="row pl-md-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Exam type *</label>
                                            <select name="exam_type" id="exam-type" class="@error('exam_type') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="1"><strong>Normal Exam: </strong>Easy 40% - Medium: 40% - Hard: 20%</option>
                                                <option value="2"><strong>Mid-term Exam: </strong> Easy: 50% - Medium: 40% - Hard: 10%</option>
                                                <option value="3"><strong>Final Exam: </strong> Easy: 50% - Medium: 30% - Hard: 20%</option>
                                            </select>
                                            @error('exam_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Number of sets *</label>
                                            <select name="number_of_set" id="number-of-set" class="@error('number_of_set') is-invalid @enderror form-control">
                                                <option selected></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                            @error('number_of_set')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Questions per set *</label>
                                            <select name="question_per_set" id="question-per-set" class="@error('question_per_set') is-invalid @enderror form-control">
                                                <option selected></option>
                                            </select>
                                            <strong>Note</strong>: you have to choose duration in order to use this function
                                            @error('question_per_set')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 5 --}}
                            <div class="form-content mt-3">
                                <div class="row pl-md-4 pt-2">
                                    <div class="col-md-12">
                                    <hr class="separator">
                                        <div class="form-group">
                                            <h3>Exam extra student(s)</h3>
                                            Use this form to add student(s) that not in the selected class, if you do not want to add any extra student, leave it empty.
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
                                <div class="row pl-md-4">
                                    <div class="col-md-12">
                                        <div class="student-list p-2 border border-darken-1" id="studentList">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="extra_student" id="extra_student" value="">
                            <div class="row pl-md-4 mt-4">
                                <div class="col-md-12"><hr class="separator"></div>
                                <button type="button" id="createExam" class="btn create-button btn-block">Create Exam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
