@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        Question Detail
                    </div>

                    <div class="card-body">
                        <form>
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
                                <button type="submit" class="btn btn-success btn-block">Edit this Question</button>
                                <button type="submit" class="btn btn-danger btn-block">Delete this Question</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
