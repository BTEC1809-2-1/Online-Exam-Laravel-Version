@extends('Admin.layouts.admin')
@section('style')
	<link rel="stylesheet" href="{{ asset('css/question.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{asset('js/changeAnswerByQuestionType.js')}}"></script>
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Create New Question
				</div>
				<div class="card-body">
					<form action="{{route('question.store')}}" method="POST">
							@csrf
						<div class="form-group">
							<label for="">Question ID</label>
							<input type="text" class="form-control" name="id">
						</div>
						<div class="form-group">
							<label for="">Question</label>
							<input type="text" class="form-control" name="question">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="">Type</label>
								<select class="form-control" id="questionType" name="questionType">
									<option selected></option>
									<option value="mc4">Multiple choices of 4</option>
									<option value="tf">True False</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="">Subject</label>
								<select class="form-control" name="subject" id="subject">
									<option selected></option>
									<option>Information Technology</option>
									<option>Business Management</option>
									<option>Designing</option>
								</select>
							</div>
						</div>
						//TODO: add answer group here
						<div class="form-row answer-block my-2" id="answer-block">
                            
						</div>
						<button type="submit" class="btn question-create btn-block">Create Question</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
