@extends('Admin.layouts.admin')
@section('pagename')
Create New Question
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
    <style>
        .question-label {
            display: flex;
            flex-direction: row;
        }
        label{
            font-weight: bold;
        }
    </style>
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
                        Note: The maximum difficulity level of True False type question is medium
                    </div>
                    <div class="card-body">
                        <form action="{{route('question.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Question Content</label>
                                <textarea rows="10" cols="50" type="text" class="form-control" name="question"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">Type</label>
                                    <select class="form-control" id="questionType" name="questionType">
                                        <option selected></option>
                                        <option value="SC4">Single choices of 4</option>
                                        <option value="MC4">Multiple choices of 4</option>
                                        <option value="TF">True False</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Subject</label>
                                    <select class="form-control" name="subject" id="subject">
                                        <option selected></option>
                                        <option value="IT">Information Technology</option>
                                        <option value="BM">Bussiness Management</option>
                                        <option value="DS">Graphic Design</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Difficulty (You must choose question's type first)</label>
                                    <select class="form-control" name="difficulity" id="difficult">
                                        <option selected></option>
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
                $('#questionManagement').show();
                $('#questionCreate').css({'background-color':'pink', 'border-radius':'5px'});
                $("#questionType").change(function() {
                    var selectedValue = $(this)
                        .find(":selected")
                        .val();
                    switch (selectedValue) {
                        case "SC4":
                            singleChoiceOfFour();
                            allDifficultLevelQuestion();
                        break;
                        case "MC4":
                            multipleChoiceOfFour();
                            allDifficultLevelQuestion();
                        break;
                        case "TF":
                            trueFalse();
                            normalAndMediumQuestion();
                        break;
                        default:
                            $("#answer-block").empty();
                        break;
                    }
                });
            });
            // Component using in answer block
            function multipleChoiceOfFour() {
                $("#answer-block").empty();
                $("#answer-block").append(`
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">First Answer</label>
                            <div class="form-check ml-4">
                                <input id="first-answers" class="form-check-input" type="checkbox" name="is_correct1"  value="1">
                                <label for="first-answers" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[1]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">Second Answer</label>
                            <div class="form-check ml-4">
                                <input id="second-answers" class="form-check-input" type="checkbox" name="is_correct2"  value="2">
                                <label for="second-answers" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[2]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">Third Answer</label>
                            <div class="form-check ml-4">
                                <input id="third-answers" class="form-check-input" type="checkbox" name="is_correct3"  value="3">
                                <label for="third-answers" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[3]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">Fourth Answer</label>
                            <div class="form-check ml-4">
                                <input id="fourth-answers" class="form-check-input" type="checkbox" name="is_correct4"  value="4">
                                <label for="fourth-answers" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[4]"></textarea>
                    </div>
                `);
            }
            function singleChoiceOfFour() {
                $("#answer-block").empty();
                $("#answer-block").append(`
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">First Answer</label>
                            <div class="form-check ml-4">
                                <input id="first-answer" class="form-check-input" type="radio" name="is_correct" value="1">
                                <label for="first-answer" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[1]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">Second Answer</label>
                            <div class="form-check ml-4">
                                <input id="second-answer" class="form-check-input" type="radio" name="is_correct" value="2">
                                <label for="second-answer" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[2]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">Third Answer</label>
                            <div class="form-check ml-4">
                                <input id="third-answer" class="form-check-input" type="radio" name="is_correct" value="3">
                                <label for="third-answer" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[3]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">First Answer</label>
                            <div class="form-check ml-4">
                                <input id="fourth-answer" class="form-check-input" type="radio" name="is_correct" value="4">
                                <label for="fourth-answer" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[4]"></textarea>
                    </div>
                `);
            }
            function trueFalse(){
                $("#answer-block").empty();
                $("#answer-block").append(`
                    <div class="form-group">
                        <div class="question-label">
                            <label for"firstAnswer">First Answer</label>
                            <div class="form-check ml-4">
                                <input class="form-check-input" type="radio" id="is-correct1" name="is_correct" value="1">
                                <label for="is-correct1" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[1]"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="question-label">
                            <label for"secondAnswer">Second Answer</label>
                            <div class="form-check ml-4">
                                <input class="form-check-input" type="radio" id="is-correct2" name="is_correct" value="2">
                                <label for="is-correct2" class="form-check-label" > Is Correct</label>
                            </div>
                        </div>
                        <textarea rows="10" cols="50" type="text" class="form-control" name="answer[2]"></textarea>
                    </div>
                `);
            }
            function allDifficultLevelQuestion(){
                $('#difficult').empty();
                $('#difficult').append(`
                    <option value="{{ config('app.question_level_of_difficult.normal') }}">Normal</option>
                    <option value="{{ config('app.question_level_of_difficult.medium') }}">Medium</option>
                    <option value="{{ config('app.question_level_of_difficult.hard') }}">Hard</option>
                `);
            }
            function normalAndMediumQuestion(){
                $('#difficult').empty();
                $('#difficult').append(`
                    <option value="{{ config('app.question_level_of_difficult.normal') }}">Normal</option>
                    <option value="{{ config('app.question_level_of_difficult.medium') }}">Medium</option>
                `);
            }
        </script>
    @endsection
@endsection
