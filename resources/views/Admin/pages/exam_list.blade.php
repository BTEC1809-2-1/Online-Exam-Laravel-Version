@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#examManagement').show();
            $('#examList').css({'background-color':'pink', 'border-radius':'5px'});
        });
    </script>
@endsection
@section('content')
    <div class="container" style="background-image:url({{url('/images/myimage.jpg')}})">
        @csrf
        <div class="card">
            <div class="card-header">
                Exam list
                @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            </div>
                <div class="card-body">
                    <div class="row justify-content-end px-5 mb-3">
                        <a href="{{route('create.exam')}}"class="btn create-button mx-2">Create New Exam</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Class</th>
                                <th scope="col">Start At</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listExam as $exam)
                            <tr>
                                <th>{{$exam->id}}</th>
                                <td>{{$exam->semester}}</td>
                                <td>{{$exam->classroom}}</td>
                                <td>{{$exam->start_at}}</td>
                                <td class="text-center">{{$exam->status}}</td>
                                <td class="text-center">
                                    <a href="Detail/{{$exam->id}}" class="btn detail-button">View detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center ">
                        {{$listExam->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
