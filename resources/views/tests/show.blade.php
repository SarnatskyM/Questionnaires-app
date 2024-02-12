<link href="{{ asset('css/test.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">


<form action="{{ route('test.submit', $test) }}" method="post">
    @csrf
    <div class="container">
        <div class="title">
            <p class="text-upper">{{ $test->title }}</p>
            <p class="text-under">{!! $test->description !!}</p>
        </div>
        <div class="test">
            @foreach ($test->questions as $question)
                <div class="example">
                    <div class="test__question">
                        <p>{!! $question->question_text !!}</p>
                    </div>
                    @foreach ($question->options as $option)
                        <div class="test__answer">
                            <label class="test__label">
                                <input class="test__input" type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">
                                <span class="test__text">{!! $option->option_text !!}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn">
            <p>Завершить тест</p>
        </button>
    </div>
</form>
