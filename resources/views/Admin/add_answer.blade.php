@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('script')
    <script src="{{asset('js/hiddenCheckbox.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        Create Answer
                    </div>

                    <div class="card-body">
                        <div class="row px-3">
                            <h2><span class="badge badge-primary text-white">Question id: {{$question->id}}</span></h2>
                            <h2><span class="badge badge-danger text-white ml-2">Question type: {{$question->type}}</span></h2>
                        </div>
                        <div class="row px-3">
                            <h2><span class="badge badge-warning">Question content:</span> {{$question->question}}</h2>
                        </div>
                        <form id="form" action="{{route('question.answer.store', $question->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            @if($question->type === 'Multiple choices of 4')
                            @for ($i = 0; $i < 4; $i++)
                            <div class="form-row align-items-center">
                                <div class="col-md-9">
                                  <label class="sr-only" for="inlineFormInput">Name</label>
                                  <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Answer" name="answer[{{$i}}]">
                                </div>
                                <div class="col-md">
                                  <div class="form-check mb-2">
                                    <input class="form-check-input" type="hidden" id="autoSizingCheck2" name="is_correct[{{$i}}]" value="0">
                                    <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="is_correct[{{$i}}]" value="1">
                                    <label class="form-check-label" for="autoSizingCheck">
                                      Correct answer
                                    </label>
                                  </div>
                                </div>
                              </div>
                            @endfor
                            @else
                                <div class="form-group">
                                    <label for="">Enter true answer</label>
                                    <input type="text" class="form-control">
                                    <input type="hidden" name="is_correct" value="1">
                                </div>
                                <div class="form-group">
                                    <label for="">Enter faile answer</label>
                                    <input type="text" class="form-control">
                                    <input type="hidden" name="is_correct" value="0">
                                </div>
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Add answers</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
