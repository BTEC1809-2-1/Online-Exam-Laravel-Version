@extends('Admin.layouts.admin')
@section('pagename')
    Exam Detail
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .modal-title, .modal-body {
            color: black;
        }
        .general-use-button{
            color: #000000;
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#updateButton').hide();
            $('#editButton').on('click', function(){
                $(this).hide();
                $(document).scrollTop( $("#header").offset().top );
                $('#updateButton').toggle();
                $('.editable').prop('readonly', false);
                let old_lecture =  $('.lecture').children('input').val();
                $('.lecture').children('input').remove();
                $('.lecture').append(`
                <select class="form-control" name="lecture">
                    <option selected value="`+ old_lecture +`">` + old_lecture +`</option>
                    <option value="Bui Duy Linh">Bui Duy Linh</option>
                    <option value="Nguyen Thai Cuong">Nguyen Thai Cuong</option>
                    <option value="Nguyen Van Thuan">Nguyen Van Thuan</option>
                    <option value="Truong Cong Doan">Truong Cong Doan</option>
                </select>`);
                let old_date = new Date($('.start').children('input').val()).toISOString().split('T')[0];
                let old_time = new Date($('.start').children('input').val()).getHours();
                console.log(old_time);
                $('.start').children('input').remove();
                $('.start').append(`
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Date *</label>
                                <input type="date" class="form-control" name="date" value=`+old_date+`>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Time *</label>
                                <input type="time" class="form-control" name="startTime" value="`+old_time+`">
                            </div>
                        </div>
                    </div>`);
                let old_status = $('.status').children('input').val();
                $('.status').children('input').remove();
                $('.status').append(`
                <select class="form-control" name="status">
                    <option selected value="`+ old_status+`"> `+old_status+`</option>
                    <option value="`+ {{  config('app.exam_status.Ready') }} +`">Ready</option>
                    <option value="`+ {{  config('app.exam_status.On-going') }} +`">On-going</option>
                    <option value="`+ {{  config('app.exam_status.Ended') }} +`">Ended</option>
                    <option value="`+ {{  config('app.exam_status.Cancelled') }} +`">Cancelled</option>
                </select>`);
            });

        });
        // function showRemoveQuestionAlert(id, question)
        // {
        //     $('#modalContent').empty();
        //     $('#remove').attr("href", "#");
        //     $('#modalContent').append("Question: " + question);
        //     var link = "{{ route('exam.question.remove', ['id' =>"$exam->id", 'question' =>'id']) }}"
        //     $('#remove').attr("href", link);
        //     $('#removeQuestionFromExam').modal('show');
        // }
    </script>
@endsection
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" id="header">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <li>{!! \Session::get('error') !!}</li>
                                </ul>
                            </div>
                        @endif
						<div class="row justify-content-between px-3">
							<div class="col">
                                <a href="{{ route('admin') }}" style="color: #000000"class="btn general-use-button"> < Return to dashboard</a>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('create.exam') }}" style="color: #000000"class="btn general-use-button">Create another exam ></a>
                            </div>
						</div>
					</div>
					<div class="card-body">
						<form id="form" method="POST">
                            @csrf
							<div class="form-row">
								<div class="col">
									<div class="form-group">
										<label for="">Exam ID</label>
									<input type="text" class="form-control" value="{{$exam->id}}" readonly>
                                    </div>
                                    <div class="form-group lecture">
										<label for="">Lecture</label>
									    <input type="text" class="form-control editable" value="{{$exam->lecture}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Semester</label>
										<input type="text" class="form-control"  value="{{$exam->semester}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Classroom</label>
										<input type="text" class="form-control"  value="{{$exam->classroom}}" readonly>
									</div>
									<div class="form-group start">
										<label for="">Start At</label>
										<input type="text" class="form-control editable" value="{{$exam->start_at}}" readonly>
									</div>
									<div class="form-group">
										<label for="">Duration</label>
										<input type="text" class="form-control" value="{{$exam->duration}}" readonly>
                                    </div>
                                    <div class="form-group status">
										<label for="">Status</label>
										<input type="text" class="form-control editable" value="{{array_search($exam->status, config('app.exam_status'))}}" readonly>
									</div>
                                </div>
                                {{-- <a class="btn detail-button mb-lg-3" style="width: 100%" href="{{ route('get.Exam.QuestionSets', ['id' => $exam->id]) }}">View Students take part in this exam</a> --}}
                                <div class="col-md-12 exam-question" style="max-height: 500px; overflow-y: scroll; margin-bottom: 2em;">
                                    <hr>
                                    <div class="form-row justify-content-center">
										<h3>Students take part in this exam</h3>
                                    </div>
                                    <div class="form-group">
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th class="w-10">#</th>
                                                    <th class="w-30">Student ID</th>
                                                    <th class="w-20">Class</th>
                                                    <th class="w-30">Student Name</th>
                                                    <th class="w-20">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                    <?php $i = 1;?>
                                                    @foreach ($student_in_exam as $student)
                                                        <tr>
                                                            <td><?php echo $i;?></td>
                                                            <td>{{$student->id}}</td>
                                                            <td>{{$student->class}}</td>
                                                            <td>{{$student->name}}</td>
                                                            <td class="text-center">
                                                                <a class="btn detail-button" href="">Detail</a>
                                                                <a href="{{ route('exam.remove.student', [$exam->id, $student->id]) }}" class="btn create-button">Remove</a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++;?>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col exam-question" style="max-height: 500px; overflow-y: scroll; margin-bottom: 2em;">
									<div class="form-row justify-content-center">
										<h3>QUESTION USED IN THIS EXAM</h3>
                                    </div>
                                    <div class="form-group">
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th class="w-10">#</th>
                                                    <th class="w-60">Question ID</th>
                                                    <th class="w-40 text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @if ($exam_questions!==null)
                                                    <?php $i = 1;?>
                                                    @foreach ($exam_questions as $question)
                                                        <tr>
                                                            <td><?php echo $i;?></td>
                                                            <td>{{$question->id}}</td>
                                                            <td class="text-right">
                                                                <a class="btn detail-button" style="width: 100%" href="{{ route('get.question.detail', ['id' => $question->id]) }}">Detail</a>
                                                                {{-- <button type="button" class="btn create-button" onclick="showRemoveQuestionAlert('{{  $question->id}}','{{ $question->question }}' )">Remove</button> --}}
                                                            </td>
                                                        </tr>
                                                        <?php $i++;?>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
							</div>
							<div class="form-group">
                                <a class="btn detail-button mb-lg-3" style="width: 100%" href="{{ route('get.Exam.QuestionSets', ['id' => $exam->id]) }}">View Exam Question Sets</a>
                                <button type="button" id="editButton" class="btn detail-button btn-block">Edit</button>
                                <button type="submit" id="updateButton" class="btn detail-button btn-block mt-0">Update</button>
								<button type="button" class="btn create-button btn-block">Delete this Exam</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    {{-- Alert remove question from Exam
    <div class="modal fade" id="removeQuestionFromExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to remove this question from the exam?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="remove" >Remove</button>
                </div>
            </div>
        </div>
    </div> --}}
 @endsection
