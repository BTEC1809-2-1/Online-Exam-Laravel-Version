@extends('Admin.layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
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
                            <div class="form-row">
                                <?php $counter = 1;?>
                                @foreach ($answers as $aIndex=>$answer)
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Answer <?php echo $counter; $counter++?></label>
                                        <input type="text" class="form-control" value="{{$answer->answer}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Is correct</label>
                                        @if ($answer->is_correct > 0)
                                            <input type="text" class="form-control" value="Correct" readonly>
                                        @else
                                            <input type="text" class="form-control" value="Not correct" readonly>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button id="edit" class="btn btn-block detail-button">Edit</button>
                            </div>
                            <div class="form-group" id="update">
                                <a href="{{route('question.update', ['id' => $question->id])}}"  class="btn detail-button btn-block" role="button">Update</a>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                                Delete this question
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <a href="{{route('question.delete', ['id' => $question->id])}}" class="btn question-delete btn-block" role="button">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
