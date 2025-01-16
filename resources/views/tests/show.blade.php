@extends('layouts.app')

@section('title', $test->title)

@section('content')
    <form action="{{ route('test.submit', $test) }}" method="post" class="form">
        @csrf
        <div class="section">
            <div class="main">
                <div class="container">
                    <div class="title">
                        <p class="title__main">{{ $test->title }}</p>
                        <p class="title__description">{!! $test->description !!}</p>
                    </div>
                    <div class="test">
                        @foreach ($test->questions()->orderBy('sort', 'asc')->get() as $question)
                            <div class="test__item">
                                <div class="test__question">
                                    <p class="test__question-text">{!! $question->question_text !!}</p>
                                </div>

                                @if ($question->type === 'strange_check')
                                    <div class="test__answers test__answers--strange-check">
                                        @foreach ($question->options as $option)
                                            <div class="test__answer-group">
                                                <div class="test__answer-text">{!! $option->option_text !!}</div>
                                                <div class="test__answer-scale">
                                                    @foreach (range(1, 10) as $item)
                                                        <label class="test__label">
                                                            <input class="test__input"
                                                                @if ($question->is_required) required @endif
                                                                type="radio"
                                                                name="answers[{{ $question->id }}][{{ $option->id }}!]"
                                                                value="{{ $item }}">
                                                            <span class="test__value">{{ $item }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($question->type === 'select')
                                    <div class="test__select-wrapper">
                                        <select
                                            class="test__select @if ($question->is_prural) test__select--multiple @endif"
                                            @if ($question->is_required) required @endif
                                            name="answers[{{ $question->id }}]{{ $question->is_prural ? '[]' : '' }}"
                                            @if ($question->is_prural) multiple @endif>
                                            <option selected disabled>Select an answer...</option>
                                            @foreach ($question->options as $option)
                                                <option value="{{ $option->id }}">{{ $option->option_text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if ($question->type === 'text')
                                    <div class="test__answers test__answers--text">
                                        @foreach ($question->options as $option)
                                            <label class="test__label">
                                                <input class="test__input" @if ($question->is_required) required @endif
                                                    type="{{ $question->is_prural ? 'checkbox' : 'radio' }}"
                                                    name="answers[{{ $question->id }}][]" value="{{ $option->id }}">
                                                <span class="test__value">{!! $option->option_text !!}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($question->type === 'free_text')
                                    <div class="test__answers test__answers--free-text">
                                        <textarea class="test__textarea" @if ($question->is_required) required @endif
                                            name="answers[{{ $question->id }}][{{ $question->id }}]"></textarea>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="button">
                        <span class="button__text">Complete the test</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
