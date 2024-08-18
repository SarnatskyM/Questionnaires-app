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
            @foreach ($test->questions()->orderBy('sort', 'asc')->get() as $question)
            <div class="example">
                <div class="test__question">
                    <p class="test_question-text">{!! $question->question_text !!}</p>
                </div>

                @if ($question->type === 'strange_check')
                <div class="test__answer flex">
                    @foreach ($question->options as $option)
                    <div class="flex_unrow">
                        <div class="text-mark">
                            {!! $option->option_text !!}
                        </div>

                        @foreach (range(1, 10) as $item)
                        <label class="test__label">
                            <input class="test__input" @if ($question->is_required === 1) required @endif
                            type="radio" name="answers[{{$question->id }}][{{$option->id}}!]"
                            value="{{$item}}">
                            <span class="test__text">{{$item}}</span>
                        </label>

                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif

                @if ($question->type === 'select')
                @if ($question->is_prural)
                <select id="{{ isset($question->question_id) ? $question->question_id : $question->question_text }}" class="test__input-prural-select" @if ($question->is_required === 1) required @endif
                    name="answers[{{$question->id}}][]" multiple>
                    @else
                    <select id="{{ isset($question->question_id) ? $question->question_id : $question->question_text }}" class="test__input" @if ($question->is_required === 1) required @endif
                        name="answers[{{ $question->id }}][{{ $question->id }}]">
                        @endif
                        <option selected disabled>Select an answer..</option>
                        @foreach ($question->options as $option)
                        <option value="{{ $option->id }}">{{ $option->option_text }}</option>
                        @endforeach
                    </select>
                    @elseif ($question->type === 'text')
                    @if ($question->is_prural)
                    <div class="test__answer">
                        @foreach ($question->options as $option)
                        <label class="test__label">
                            <input class="test__input" @if ($question->is_required === 1) required @endif
                            type="checkbox" name="answers[{{ $question->id }}][]"
                            value="{{ $option->id }}">
                            <span class="test__text">{!! $option->option_text !!}</span>
                        </label>
                        @endforeach
                    </div>
                    @else
                    <div class="test__answer">
                        @foreach ($question->options as $option)
                        <label class="test__label">
                            <input class="test__input" @if ($question->is_required === 1) required @endif
                            type="radio" name="answers[{{ $question->id }}][]"
                            value="{{ $option->id }}">
                            <span class="test__text">{!! $option->option_text !!}</span>
                        </label>
                        @endforeach
                    </div>
                    @endif
                    @elseif ($question->type === 'free_text')
                    <div class="example">
                        <div class="test__answer">
                            <textarea class="test__input-area" @if ($question->is_required === 1) required @endif
                                    name="answers[{{ $question->id }}][{{ $question->id }}]"></textarea>
                        </div>
                    </div>
                    @endif
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn">
            <p>Complete the test</p>
        </button>
    </div>
</form>
