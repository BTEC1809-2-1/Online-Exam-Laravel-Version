@extends('Admin.layouts.admin')
@section('pagename')
    Exam Detail
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .question-set
        {

        }
    </style>
@endsection
@section('script')
    <script type="text/javascript">

    </script>
@endsection
@section('content')
	<div class="container" style="width: 100vw; margin: 1rem 1rem;">
		<div class="row justify-content-center" style="width: 1600px;">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row justify-content-between px-3">
                            <div class="col">
                                <a href="{{ route('get.exam.detail', ['id' => request()->route()->parameters['id']]) }}" style="color: black" class="btn general-use-button">< Return to exam detail</a>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin') }}" style="color: black"class="btn general-use-button mr-0"> Return to dashboard ></a>
                            </div>
						</div>
					</div>
					<div class="card-body" style=" color: #000">
						<form id="form">
							<div class="form-row">
                                <div class="col">
                                    <h3>General information:</h3>
                                    <div class="row">
                                        <div class="col">
                                            <span>
                                                <b>Belong to exam:</b> {{ request()->route()->parameters['id'] }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span><b>Number of set created:</b> {{ $number_of_sets_created }} </span>
                                        </div>
                                        <div class="col">
                                            <span><b>Number of question per set:</b> {{ $number_of_questions_per_set}}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col"><span><b>Number of normal questions:</b> {{ $normal }}</span></div>
                                        <div class="col"><span><b>Number of medium questions:</b> {{ $medium }} </span></div>
                                        <div class="col"><span><b>Number of hard questions:</b> {{ $hard }} </span></div>
                                    </div>
                                    <hr><br>
                                    <h3>Sets detail:</h3>
                                    <hr>
                                    <div class="row">
                                        @foreach ($exam_question_sets as $set)
                                            <div class="col question-set" style="max-height: 500px; overflow-y: scroll; margin-bottom: 2em;">
                                                <div class="row justify-content-center my-3">
                                                    <h4>Set ID: {{ $set->id }}</h4>
                                                </div>
                                                <table class="table" >
                                                    <?php
                                                    $questions = json_decode($set->questions);
                                                    foreach ($questions as $question) { ?>
                                                        <thead>
                                                            <tr>
                                                                <th class="w-60">Question ID</th>
                                                                <th class="w-40 text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody >
                                                            <tr>
                                                                <td><?php echo $question->id ?></td>
                                                                <td class="text-right">
                                                                    <a class="btn detail-button" style="width: 100%" href="{{ route('get.question.detail', ['id' => $question->id]) }}">Detail</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    <?php }?>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
 @endsection
