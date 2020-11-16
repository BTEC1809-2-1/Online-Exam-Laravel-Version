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
    </style>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#updateButton').hide();
            $('#editButton').on('click', function(){
                $(this).hide();
                $('#updateButton').toggle();
                $('input[type=text]').prop('readonly', false);
            });

        });
        function showRemoveQuestionAlert(id, question)
        {
            $('#modalContent').empty();
            $('#remove').attr("href", "#");
            $('#modalContent').append("Question: " + question);
            var link = "{{ route('exam.question.remove', ['id' =>"$exam->id", 'question' =>'id']) }}"
            $('#remove').attr("href", link);
            $('#removeQuestionFromExam').modal('show');
        }

    </script>
@endsection
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row justify-content-between px-3">
							<div class="col">
                                <a href="{{ route('admin') }}" class="btn general-use-button"">Return to dashboard</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('create.exam') }}" class="btn general-use-button"">Create another exam</a>
                            </div>
						</div>
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
										<label for="">Lecture</label>
									    <input type="text" class="form-control" value="{{$exam->lecture}}" readonly>
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
                                    <div class="form-group">
										<label for="">Status</label>
										<input type="text" class="form-control" value="{{array_search($exam->status, config('app.exam_status'))}}" readonly>
									</div>
								</div>
								<div class="col exam-question" style="max-height: 500px;
                                                                        overflow-y: scroll;
                                                                        margin-bottom: 2em;">
									<div class="form-row justify-content-center">
										<label for="">Question List</label>
                                    </div>
                                    <div class="form-group">
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th class="w-10">#</th>
                                                    <th class="w-60">Question</th>
                                                    <th class="w-40 text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @if ($exam_questions!==null)
                                                    <?php $i = 1;?>
                                                    @foreach ($exam_questions as $question)
                                                        <tr>
                                                            <td><?php echo $i;?></td>
                                                            <td>{{$question->question}}</td>
                                                            <td class="text-right">
                                                                <a class="btn detail-button" href="{{ route('get.question.detail', ['id' => $question->id]) }}">Detail</a>
                                                                <button type="button" class="btn create-button" onclick="showRemoveQuestionAlert('{{  $question->id}}','{{ $question->question }}' )">Remove</button>
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
    {{-- Alert remove question from Exam --}}
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
    </div>
 @endsection
