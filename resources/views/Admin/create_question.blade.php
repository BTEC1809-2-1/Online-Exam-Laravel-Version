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
                        Create New Question
                    </div>

                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label for="">Question ID</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Question</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="">Type</label>
                                    <select class="form-control">
                                        <option>Multiple choices of 4</option>
                                        <option>Multiple choices of 2</option>
                                        <option>True False</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Subject</label>
                                    <select class="form-control">
                                        <option>Information Technology</option>
                                        <option>Business Management</option>
                                        <option>Designing</option>
                                    </select>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success btn-block">Create Question</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
