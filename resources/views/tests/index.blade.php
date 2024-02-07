<h1>Список доступных тестов</h1>

@foreach ($tests as $test)
    <div>
        <a href="{{ route('test.show', $test) }}">{{ $test->title }}</a>
    </div>
@endforeach
