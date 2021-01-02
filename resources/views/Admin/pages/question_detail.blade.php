@extends('Admin.layouts.admin')
@section('pagename')
Question Detail
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
@endsection
@section('script')
    <script src="{{ asset('js/updateQuestion.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between px-4">
                            <div class="row justify-content-between px-3">
                                <div class="col">
                                    <a href="{{ route('get.question.list') }}" class="btn general-use-button back">Return to question list</a>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('admin') }}" class="btn general-use-button forward">Return to dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Question ID</label>
                                    <input type="text" class="form-control" value="{{$question->id}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <input type="text" class="form-control" id="type"  value="{{array_search($question->type, config('app.question_type'))}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Subject</label>
                                        <input type="text" class="form-control" value="{{array_search($question->subject, config('app.subject'))}}" readonly>
                                    </div>
                                    <div class="form-group" id="difficult">
                                        <label for="">Level Of Difficult</label>
                                        <input type="text" class="form-control editable" name="level_of_difficult" value="{{array_search($question->level_of_difficult,  config('app.question_level_of_difficult')) }}" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Created at</label>
                                        <input type="text" class="form-control" value="{{$question->created_at}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Creted by</label>
                                        <input type="text" class="form-control" value="{{$question->created_by}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Updated at</label>
                                        <input type="text" class="form-control" value="{{$question->updated_at}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Updated by</label>
                                        <input type="text" class="form-control" value="{{$question->updated_by}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">Question</label>
                                    <textarea rows="10" cols="50" type="text" class="form-control editable" name="question" readonly>{{$question->question}}</textarea>
                                </div>
                                @foreach ($answers as $answer)
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="">Answer {{ $answer->index }}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group row is_correct" id="{{ $answer->index }}">
                                                    @if ($question->type == 'TF' or $question->type == 'SC4')
                                                        @if ($answer->index == $is_correct)
                                                            <input type="text" class="form-control" value="Correct" readonly>
                                                        @else
                                                            <input type="text" class="form-control" value="Not correct" readonly>
                                                        @endif
                                                    @else
                                                        @if (($is_correct[$answer->index - 1] != 0))
                                                            <input type="text" class="form-control" value="Correct" readonly>
                                                        @else
                                                            <input type="text" class="form-control" value="Not correct" readonly>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <textarea rows="10" cols="50" type="text" class="form-control editable" name="answer[{{ $answer->index }}]" readonly>{{ $answer->content}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button id="edit" class="btn btn-block detail-button">Edit</button>
                            </div>
                            <div class="form-group" id="update">
                                <button type="button" class="btn detail-button btn-block" id="submitUpdate">Update</button>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" >
                                Delete this question
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteQuestion" tabindex="-1" role="dialog" aria-labelledby="deleteQuestion" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete this question?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="">ID</label>
                                <input type="text" class="form-control" value="{{$question->id}}">
                                <label for="">Question</label>
                                <input type="text" class="form-control" value="{{$question->question}}">
                                <label for="">Subject</label>
                                <input type="text" class="form-control" value="{{$question->subject}}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <div class="form-group">
                            <a href="{{route('question.delete', ['id' => $question->id])}}" class="btn delete-button btn-block" role="button">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
