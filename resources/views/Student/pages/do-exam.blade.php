    @extends('Student.layouts.student')
@section('title')
    <title>Yeu Thu Hang Nhat Tren Doi</title>
@endsection
@section('style')
    <style>
        .do-exam{
            min-height: 500px;
            max-height: 700px;
            overflow-y: scroll;
            overflow-x: auto;
        }
        .question-content
        {
            font-weight: bold;
            font-size: 18px;
        }
        ul{
            list-style-type: none;
        }
        .question {
            border: 1px solid;
            border-radius: 10px;
            margin: 1em;
        }
        .answer {
            border: 1px solid;
            border-radius: 10px;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('.answer').on('click', function (e) {
                if ($(e.target).is('#answer_*')) {
                        e.stopPropagation();
                } else {
                    if ($('input:radio', this).prop('checked') === true) {
                        return false;
                    }

                    $('input:radio', this).prop('checked', true);

                    let checkBox = $(this).find("input[type='checkbox']");

                    if (checkBox.is(":checked") == false) {
                        checkBox.prop("checked", true);
                    } else {
                        checkBox.prop("checked", false);
                    }
                }

                if ($(this).attr('id').includes('s_')) {
                    $(this).parent()
                    .find('.answer')
                    .not($(this))
                    .css({
                        'background':'white',
                        'color':'black'
                    });

                    $(this).css({'background':'#5eb44b', 'color':'white'});

                } else {
                    if($(this).children('input[type="checkbox"]').is(':checked')) {
                        $(this).css({'background':'#5eb44b', 'color':'white'});
                    } else {
                        $(this).css({'background':'white', 'color':'black'});
                    }
                }
            });
        });
    </script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center w-100 px-auto">
            <div class="col-md-10">
                <form action="{{route('submit.exam')}}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-center pt-3">
                                <div class="col-md-6">
                                    <div class="row p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-default">Exam ID</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="exam_id" value="{{$exam->id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-default " readonly>Time Remaining</span>
                                            </div>
                                            <input type="text" id="countdown" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{Auth::user()->id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <button type="submit" class="btn create-button btn-block">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col do-exam pt-2 pl-5">
                                    <div class="card mt-2 mb-2">
                                        <div class="card-header px-5">
                                            <h4>Question</h4>
                                        </div>
                                        @foreach($questions ?? '' as $qIndex=>$question)
                                        <div class="card-body question px-5">
                                            <input type="hidden" name="questions[{{$qIndex + 1}}]" value="{{$question['id']}}">
                                            <div class="row">
                                                <h4>Question {{ $qIndex + 1 }}
                                                    @if ($question['question']->type != 'MC4')
                                                        (Choose the right answer! The is only one correct answer!)
                                                    @else
                                                        (Choose the right answers, there can be more than one correct answer!)
                                                    @endif
                                                </h4>
                                            </div>
                                            <span class="question-content" >{{$question['question']->question}}</span>
                                            <div class="row justify-content-around">
                                                <div class="col-md-12 p-1">
                                                    @foreach ($question['answers'] as $aIndex=>$answer)
                                                        @if ($question['question']->type != 'MC4')
                                                            <div class="answer my-3 p-2" id="s_answer{{ $aIndex }}">
                                                                <input
                                                                type="radio"
                                                                name="answers[{{$qIndex + 1}}]"
                                                                id="answer_{{$qIndex + 1}}"
                                                                value="{{$aIndex + 1}}"
                                                                style="display:none;"
                                                                >
                                                                {{$answer->content}} Lorem ipsum dolor sit amet consectetur adipisicing
                                                                elit. Iure, asperiores consequuntur veritatis, dolore, laudantium eaque
                                                                deserunt velit perferendis quos perspiciatis quam incidunt animi?
                                                                Pariatur alias, sunt quaerat doloremque sit at consequuntur perferendis
                                                                dolorem architecto nostrum omnis minus repellendus et voluptatem ullam a
                                                                laudantium modi ex hic eligendi deleniti sint. Saepe, sit qui placeat
                                                                quaerat laudantium ipsa iste debitis minus doloribus praesentium perspiciatis
                                                                cum expedita quisquam temporibus, porro, accusamus nisi vel omnis nostrum
                                                                repellat quidem veniam molestias modi iusto? Natus omnis culpa nemo quia
                                                                dicta explicabo. Dicta dolore eaque minima id inventore magni aspernatur,
                                                                fuga minus quidem ipsam deserunt culpa aperiam.
                                                            </div>
                                                        @else
                                                            <div class="answer my-3 p-2" id="m_answer{{ $aIndex }}">
                                                                <input
                                                                type="checkbox"
                                                                name="answers[{{$qIndex + 1}}][]"
                                                                id="answer_{{$qIndex + 1}}"
                                                                value="{{$aIndex + 1}}"
                                                                style="display:none;"
                                                                >
                                                                {{$answer->content}} Lorem ipsum dolor sit amet consectetur adipisicing
                                                                elit. Iure, asperiores consequuntur veritatis, dolore, laudantium eaque
                                                                deserunt velit perferendis quos perspiciatis quam incidunt animi?
                                                                Pariatur alias, sunt quaerat doloremque sit at consequuntur perferendis
                                                                dolorem architecto nostrum omnis minus repellendus et voluptatem ullam a
                                                                laudantium modi ex hic eligendi deleniti sint. Saepe, sit qui placeat
                                                                quaerat laudantium ipsa iste debitis minus doloribus praesentium perspiciatis
                                                                cum expedita quisquam temporibus, porro, accusamus nisi vel omnis nostrum
                                                                repellat quidem veniam molestias modi iusto? Natus omnis culpa nemo quia
                                                                dicta explicabo. Dicta dolore eaque minima id inventore magni aspernatur,
                                                                fuga minus quidem ipsam deserunt culpa aperiam.
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr >
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
