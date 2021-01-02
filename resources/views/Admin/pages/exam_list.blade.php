@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/exam-list.css') }}">
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $('td').each(function(){
                if( $(this).text()=="Ready"){
                $(this).css('color', 'blue');
                }
                if( $(this).text()=="On-going"){
                    $(this).css('color', 'green');
                }
                if( $(this).text()=="Ended"){
                    $(this).css('color', 'red');
                }
            });
        });
    </script>
@endsection
@section('pagename')
    Exam list
@endsection
@section('content')
    <div class="admin-content-body">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-11">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin') }}" class="btn create-button mx-2 back">Back to Dashboard</a>
                        <a href="{{ route('create.exam') }}" class="btn create-button mx-2 forward">Create new Exam</a>
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
                                <div class="col-md-8">
                                    <form class="form">
                                        @csrf
                                        <div class="row justify-content-end">
                                            <input class="form-control mr-1 exam-search-bar" type="search" placeholder="Search" aria-label="Search" id="search">
                                            <button class="btn search-button my-2 my-sm-0" type="submit">Search</button>
                                            <div class="questionList"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <select name="exam_sort_by" class="custom-select">
                                        <option selected> Sort By Subject</option>
                                        <option value="IT">Information Technology</option>
                                        <option value="BM">Business Management</option>
                                        <option value="GD">Graphic Design</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Start At</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listExam as $exam)
                                        @if (\Session::has('success') and ($exam->id == \Session::get('exam_id') ))
                                            <tr style="background: #DCF1DC">
                                                <th>{{$exam->id}}</th>
                                                <td>{{array_search($exam->subject, config('app.subject'))}}</td>
                                                <td>{{array_search($exam->semester, config('app.semester'))}}</td>
                                                <td>{{$exam->classroom}}</td>
                                                <td>{{$exam->start_at}}</td>
                                                <td class="text-center exam-status">{{ array_search($exam->status, config('app.exam_status'))}}</td>
                                                <td class="text-center">
                                                    <a href="Detail/{{$exam->id}}" class="btn detail-button">View detail</a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <th>{{$exam->id}}</th>
                                                <td>{{array_search($exam->subject, config('app.subject'))}}</td>
                                                <td>{{array_search($exam->semester, config('app.semester'))}}</td>
                                                <td>{{$exam->classroom}}</td>
                                                <td>{{$exam->start_at}}</td>
                                                <td class="text-center exam-status">{{ array_search($exam->status, config('app.exam_status'))}}</td>
                                                <td class="text-center">
                                                    <a href="Detail/{{$exam->id}}" class="btn detail-button">View detail</a>
                                                </td>
                                            </tr>
                                        @endif
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
        </div>
    </div>
@endsection
