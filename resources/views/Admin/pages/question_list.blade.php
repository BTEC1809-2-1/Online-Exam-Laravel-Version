@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
@endsection
@section('content')
<div class="container" style="background-image:url({{url('/images/myimage.jpg')}})">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>
                <div class="card-body">
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
                    <div class="row text-center justify-content-between">
                        <b class="my-auto ml-md-5">{{ Auth::user()->name }}</b>
                        <nav class="navbar navbar-light justify-content-between">
                            <form class="form-inline">
                                @csrf
                                <input class="form-control mr-sm-2 w-80" type="search" placeholder="Search" aria-label="Search" id="search">
                                <button class="btn search-button my-2 my-sm-0" type="submit">Search</button>
                                <div class="questionList"></div>
                            </form>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Question list
                </div>
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <a href="{{route('create.question')}}">
                            <button type="button" class="btn question-create-button mx-5">Create New question</button>
                        </a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Question</th>
                                <th scope="col" class="text-center">Type</th>
                                <th scope="col" class="text-center">Subject</th>
                                <th scope="col colspan-3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listQuestion as $question)
                            <tr>
                                <th>{{$question->id}}</th>
                                <td>{{$question->question}}</td>
                                <td class="text-center">{{$question->type}}</td>
                                <td class="text-center">{{$question->subject}}</td>
                                <td class="text-center">
                                    <a class="btn btn-block detail-button" href="{{route('get.question.detail',
                                                ['id' => $question->id])}}">
                                        View detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center pagination">
                        {{$listQuestion->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        $(document).ready(function(){
            $('#search').on('keyup change', function(){
                console.log('haha');
                var query = $(this).val();
                if(query != '')
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('search') }}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#questionList').fadeIn();
                            $('#questionList').html(data);
                        }
                    });
                }
            });
        });
        $(document).on('click', 'li', function(){
            $('#search').val($(this).text());
            $('#questionList').fadeOut();
        });
    </script>
@endsection
@endsection
