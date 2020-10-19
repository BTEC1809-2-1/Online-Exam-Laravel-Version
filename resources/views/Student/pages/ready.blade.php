@extends('Student.layouts.student')
@section('title')
  <title>Yeu Thu Hang Nhat Tren Doi</title>
@endsection
@section('style')
    <style>
        input[readonly]
        {
            background: white;
        }
    </style>
@endsection
@section('script')
    <script>
      $(document).ready(function() {
        var doUpdate = function() {
          $('#countdown').each(function() {
            var count = parseInt($(this).html());
            if (count !== 0) {
              $(this).html(count - 1);
            }
            else
            {
                $('#do-exam-button').attr('href', "{{route('do.exam.page', [$exam->id])}}")
            }
          });
        };
        setInterval(doUpdate, 60000);
      });
    </script>
@endsection
@section('content')
  <div class="container p-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-9 text-left pt-2">Các em ơi, nhớ lấy lời anh. Ngã ở đâu mình uống rượu ở đấy, không việc gì phải buồn!</div>
                    <div class="col-md-3"><a href="{{route('logout')}}" class="btn button-small btn-danger">Logout</a></div>
                </div>
            </div>
            <div class="card-body px-5">
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value={{Auth::user()->id}} readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">Subject</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$exam->subject}}" readonly>
                    </div>
                </div>
                <div class="row ">
                    <div class="col pl-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{date('H:i:s', strtotime($exam->start_at))}}" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Duration</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{$exam->duration}}"readonly>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Count Down</span>
                            </div>
                            <div type="text" class="form-control" id="countdown" aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
                                @if(isset($status)) {{Carbon\Carbon::now()->diffInMinutes(Carbon\Carbon::parse($exam->start_at))}} @else 0 @endif
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Minutes</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Status</span>
                            </div>
                            <input type="text" class="form-control" id="countdown" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="@if(isset($status)) Ready @else Test Done @endif" readonly>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($status))
                <div class="card-footer">
                    <a class="btn btn-block create-button" id="do-exam-button">Start</a>
                </div>
            @endif
        </div>
      </div>
    </div>
  </div>
@endsection
