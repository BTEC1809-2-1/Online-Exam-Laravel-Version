@extends('Admin.layouts.admin')
@section('pagename')
Question Detail
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
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
                                    {{-- <input type="text" class="form-control"  value="{{$question->question}}" readonly> --}}
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
                                                    {{-- <label for="">Is correct</label> --}}
                                                    @if ($question->type == 'TF' or $question->type === 'SC4')
                                                        @if ($answer->index == $is_correct)
                                                            <input type="text" class="form-control" value="Correct" readonly>
                                                        @else
                                                            <input type="text" class="form-control" value="Not correct" readonly>
                                                        @endif
                                                    @else
                                                        @if (($is_correct[$answer->index - 1] !== 0))
                                                            <input type="text" class="form-control" value="Correct" readonly>
                                                        @else
                                                            <input type="text" class="form-control" value="Not correct" readonly>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <input type="text" class="form-control" value="{{$answer->content}}" readonly> --}}
                                        <textarea rows="10" cols="50" type="text" class="form-control editable" name="answer[{{ $answer->index }}]" readonly>{{ $answer->content}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button id="edit" class="btn btn-block detail-button">Edit</button>
                            </div>
                            <div class="form-group" id="update">
                                {{-- <a href="#"  class="btn detail-button btn-block" role="button">Update</a> --}}
                                {{-- <a href="{{route('question.update', ['id' => $question->id])}}"  class="btn detail-button btn-block" role="button">Update</a> --}}
                                <button type="button" class="btn detail-button btn-block" id="submitUpdate">Update</button>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#deleteQuestion">
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
    @section('script')
        <script type="text/javascript">
            $(document).ready(function(){
                $(function(){
                    $('#edit').one('click' ,function(e) {
                        e.preventDefault();
                        $(this).html() == "Edit" ? updateOn() : submitUpdate();
                    });
                });
                var is_correct = null;
                function updateOn() {
                    $('#edit').parent().css('display','none');
                    $('#update').show();
                    $('#difficult').append(`
                        <select class="form-control" name="level_of_difficult" required>
                            <option value="1">Normal</option>
                            <option value="2">Medium</option>
                            <option value="3">Hard</option>
                        </select> `);
                    $('#difficult').children('input').remove();
                    var question_type = $('#type').val();
                    if(question_type == 'Single Choice 4' ?? question_type == 'True False'){
                        is_correct = 0;
                    }else {
                        is_correct = [];
                    }
                    var old_select_index = 1;
                    $('.is_correct').empty();
                    $('.is_correct').each( function(index){
                        $(this).append(`
                            <select class="form-control" id="select_is_correct`+index+`" required>
                                <option selected></option>
                                <option value="0">Not Correct</option>
                                <option value="1">Correct</option>
                            </select>`);
                        $('#select_is_correct'+index).on('change', function(){
                            if(question_type == 'Single Choice 4' ?? question_type == 'True False'){
                                if($(this).children('option:selected').val()== 1 ){
                                    $('#select_is_correct'+old_select_index).val('0');
                                    is_correct = ($(this).parent().attr('id'));
                                }
                            } else {
                                is_correct.push("");
                                if($(this).children('option:selected').val()== 1 ){
                                    is_correct[index] = String($(this).parent().attr('id'));
                                } else {
                                    is_correct[index] = "0";
                                }
                            }
                            old_select_index = index;
                        });
                    });
                    console.log(is_correct);
                    $(".editable").prop('readonly', false);
                }
                $('#submitUpdate').on('click', function(){
                    console.log(is_correct);
                    $('#form').append(`<input type="hidden" name="is_correct" value="`+is_correct+`">`);
                    $('#form').submit();
                })
            });
        </script>
    @endsection
@endsection
