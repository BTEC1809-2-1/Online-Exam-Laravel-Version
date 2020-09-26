@extends('Admin.layouts.admin')
@section('style')
	<link rel="stylesheet" href="{{ asset('css/question.css') }}">
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
									<option value="IT">Môn có thầy Linh dạy</option>
									<option value="BM">Môn có em <3</option>
									<option value="DS">Môn gì đây?</option>
								</select>
							</div>
						</div>
						<div class="form-row answer-block mb-2">
                            <div class="col" id="answer-block"></div>
						</div>
						<button type="submit" class="btn create-button btn-block">Create Question</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@section('script')
    <script type="text/javascript">
    $(document).ready(function() {
        $("#questionType").change(function() {
            var selectedValue = $(this)
                .find(":selected")
                .val();
            console.log(selectedValue);
            switch (selectedValue) {
                case "SC4":
                    singleChoiceOfFour();
                    break;
                case "MC4":
                    multipleChoiceOfFour();
                    break;
                case "TF":
                    trueFalse();
                    break;
                default:
                    $("#answer-block").empty();
                    break;
            }
        });
    });
    // Component using in answer block
    function singleChoiceOfFour() {
        $("#answer-block").empty();

        $("#answer-block").append(`
            <div class="form-group">
            <label for"firstAnswer">First Answer</label>
            <input type="text" class="form-control" name="answer[1]">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_correct[1]"  value="1">
                <label class="form-check-label" > is correct </label>
            </div>
            </div>

            <div class="form-group">
            <label for"firstAnswer">Second Answer</label>
            <input type="text" class="form-control" name="answer[2]">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_correct[2]"  value="1">
                <label class="form-check-label" > is correct </label>
            </div>
            </div>
            <div class="form-group">
                <label for"firstAnswer">Third Answer</label>
                <input type="text" class="form-control" name="answer[3]">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_correct[3]"  value="1">
                    <label class="form-check-label" > is correct </label>
                </div>
            </div>
            <div class="form-group">
                <label for"firstAnswer">Fourth Answer</label>
                <input type="text" class="form-control" name="answer[4]">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_correct[4]"  value="1">
                    <label class="form-check-label" > is correct </label>
                </div>
            </div>
        `);
    }

    function multipleChoiceOfFour() {
        $("#answer-block").empty();
        $("#answer-block").append(`
            <div class="form-group">
            <label for"firstAnswer">First Answer</label>
            <input type="text" class="form-control" name="answer[1]">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_correct"  value="1">
                <label class="form-check-label" > is correct </label>
            </div>
            </div>

            <div class="form-group">
            <label for"firstAnswer">Second Answer</label>
            <input type="text" class="form-control" name="answer[2]">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_correct"  value="1">
                <label class="form-check-label" > is correct </label>
            </div>
            </div>
            <div class="form-group">
                <label for"firstAnswer">Third Answer</label>
                <input type="text" class="form-control" name="answer[3]">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_correct"  value="1">
                    <label class="form-check-label" > is correct </label>
                </div>
            </div>
            <div class="form-group">
                <label for"firstAnswer">Fourth Answer</label>
                <input type="text" class="form-control" name="answer[4]">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_correct"  value="1">
                    <label class="form-check-label" > is correct </label>
                </div>
            </div>
        `);
    }

    function trueFalse(){
        $("#answer-block").empty();
        $("#answer-block").append(`
            <div class="form-group">
            <label for"firstAnswer">First Answer</label>
            <input type="text" class="form-control" name="answer[1]">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_correct" value="1">
                <label class="form-check-label" > is correct </label>
            </div>
            </div>

            <div class="form-group">
            <label for"firstAnswer">Second Answer</label>
            <input type="text" class="form-control" name="answer[2]">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_correct"  value="1">
                <label class="form-check-label" > is correct </label>
            </div>
        `);
    }

    </script>
@endsection
@endsection
