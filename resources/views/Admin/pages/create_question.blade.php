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
							<label for="">Question</label>
							<input type="text" class="form-control" name="question">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="">Type</label>
								<select class="form-control" id="questionType" name="questionType">
                                    <option selected></option>
                                    <option value="SC4">Single choices of 4</option>
									<option value="MC4">Multiple choices of 4</option>
									<option value="TF">True False</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="">Subject</label>
								<select class="form-control" name="subject" id="subject">
									<option selected></option>
									<option value="IT">Information Technology</option>
									<option value="BM">Business Management</option>
									<option value="DS">Designing</option>
								</select>
							</div>
						</div>
						<div class="form-row answer-block mb-2">
                            <div class="col" id="answer-block"></div>
						</div>
						<button type="submit" class="btn question-create btn-block">Create Question</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
