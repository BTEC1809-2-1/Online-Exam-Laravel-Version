@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/toggleEditUpdate.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <div class="row justify-content-between px-4">
                            <span class="my-auto">
                                Question Detail
                            </span>
                            <a href="{{route('question.add.answer', ['id' => $question->id])}}"><button class="btn btn-primary">Add answers to this question</button></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="form">
                            <div class="form-row">
                                <div class="col">

                                    <div class="form-group">
                                        <label for="">Question ID</label>
                                    <input type="text" class="form-control" value="{{$question->id}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Question</label>
                                        <input type="text" class="form-control"  value="{{$question->question}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <input type="text" class="form-control"  value="{{$question->type}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Subject</label>
                                        <input type="text" class="form-control" value="{{$question->subject}}" readonly>
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

                            <div class="form-group">
                                <a>
                                    <button id="edit" type="submit" class="btn btn-success btn-block">
                                        Edit
                                    </button>
                                </a>
                            </div>

                            <div class="form-group">
                                <a href="{{route('question.delete', ['id' => $question->id])}}" class="btn btn-danger btn-block" role="button">Delete</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
