@extends('layouts.app')


@section('content')
<body style="background-color: white">
    <div class="container">
        {{-- <nav class="col-lg-1 pull-right">
            <div class="sidebar-nav-fixed affix">


            <button type="button" class="btn btn-warning">Con cho an</button>
            </div>
        </nav> --}}
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <title>Bootstrap Example</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        </head>
        <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <nav class="navbar navbar-expand-sm navbar-light bg-white fixed-bottom">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#content">Nội dung bài thi</a>
            </li>
        </ul>
        </nav>
        <nav class="navbar navbar-expand-sm navbar-light fixed-bottom justify-content-end">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" ><b>Time <br> <span id="timer" style="color: red">Starting</span></b></a></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " ><button type="button" class="btn btn-warning ml-auto ">Nộp bài</button></a>
            </li>
        </ul>
        </nav>

        <div id="content" class="container " style="padding-top:70px;padding-bottom:70px" >
          <p>Hai tequila như mọi khi trong tuần <br>
        Nhạc bật Frank Sinatra nhưng mà tôi không cần<br>
        Buồn phiền từ đâu lao đến đây vây quanh<br>
        Mệt nhoài cùng tôi đang nắm tay<br>
        Em ra ban công vô tình đi ngang quầy<br>
        Hình như em đang say sau vài ly vang đầy<br>
        Tình cờ đời ta va lấy nhau, không may<br>
        Người tìm được tôi nơi đáy sâu<br><br>

        Bồi hồi nhìn nhau điếu thuốc kia đang tàn<br>
        Ngoài đường dòng xe nối tiếp nhau vội vàng<br>
        Nhiều lần hợp tan nuối tiếc trong muộn màng<br>
        Chỉ cần một ai xoá hết đi thời gian<br>
        Đừng làm trời lên khói thuốc kia thay màu<br>
        Đừng làm bầu không khí chuốc thêm ưu sầu<br>
        Đừng làm tình ta sẽ chết ngay ban đầu<br>
        Dù mập mờ không biết sẽ đi về đâu.<br><br>

        Và người nhìn bằng đôi mắt khép hờ lại bờ môi<br>
        Một người làm lòng tôi muốn có một người cần tôi<br>
        Sau bao dối gian trong đời<br>
        Yêu đương hoá ra không lời, nên...<br>
        Người chìm mình vào ao ước biến cuộc tình thành phim<br>
        Người vì vài lần đau đớn bắt lòng mình lặng im<br>
        Riêng tôi sẽ luôn yêu người<br>
        Như tôi đã luôn yêu người<br>
        Từ đầu.<br><br>

        Em thở nhẹ một sợi khói, khiến bầu trời vỡ làm hai nửa<br>
        Nếu mà anh không tới, thì cả đời đâu còn ai sửa<br>
        Đóm lửa đỏ trên đầu thuốc rơi vào gạt tàn như thể sao băng<br>
        Hồn anh như lạc đàn ở giữa bạt ngàn góc rễ bao quanh<br>
        Xin lỗi vì lòng hơi say, trong đầu thì đầy chếnh choáng<br>
        Cảm ơn những nỗi buồn vì đã đưa đôi chân này đến quán<br>
        Anh biết là nếu đêm tàn sẽ kéo thêm ngàn suy nghĩ miên man<br>
        Nên là, vui đi, để tim mình liên hoang<br>

        Người khép đôi hàng mi không sầu vương đang nhìn tôi<br>
        Người khiến tôi nhận ra tôi chỉ yêu em mà thôi<br>
        Sau bao dối gian trong đời<br>
        Yêu đương hoá ra không lời nên<br>
        Còn có bao người mong cho tình yêu kia thành phim<br>
        Và có bao người đau nên buộc con tim lặng im<br>
        Riêng tôi sẽ luôn yêu người<br>
        Như tôi đã luôn yêu người<br>
        Từ đầu...<br></p>
        </div>

        </body>
        </html>

    </div>
    {{-- <div class="container">
            <p>
                I still believe in your eyes
                I just don't care what you have done in your life
                Baby, I'll always be here by your side
                Don't leave me waiting too long, please come by
                I, I, I, I still believe in your eyes
                There is no choice, I belong to your life
                Because I will live to love you someday
                You'll be my baby and we'll fly away
                And I'll fly with you, I'll fly with you, I'll fly with you
                You are, are, are, are, are, are
                You are, are, are, are, are, are
                You are, are, are, are, are, are
                Every day and every night
                I always dream that you are by my side
                Oh baby, every day and every night
                Well, I said everything's gonna be alright
                And I'll fly with you, I'll fly with you, I'll fly with you
                You are, are, are, are, are, are
                You are, are, are, are, are, are
                Dream of me, I still believe in your eyes
                I just don't care what you've done in your life
                Baby, I'll always be here by your side
                Don't leave me waiting too long, please come by
                I, I, I, I still believe in your eyes
                There is no choice, I belong to your life
                Because I will live to love you some day
                You'll be my baby and we'll fly away
                And I'll fly with you, I'll fly with you, I'll fly with you
                Every day and every night
                I always dream that you are by my side
                Oh baby, every day and every night
                Well, I said everything's gonna be alright
                And I'll fly with you, I'll fly with you, I'll fly with you
                You are, are, are, are, are, are
                You are, are, are, are, are, are

            </p>
    </div> --}}
</body>
@endsection

@section('script')
<!-- script for time limitation of exam -->
<script type="text/javascript">
var count=9999999999999;
var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
function timer()
{
    if (count == 0)
    {
    clearInterval(counter);
    alert('Now you are fuck');
    window.location.href= '/';
    return;
    }
    count=count-1;
    document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
}
</script>
@endsection
