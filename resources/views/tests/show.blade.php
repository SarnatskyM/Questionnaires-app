<h1>{{ $test->title }}</h1>

<p>{{ $test->description }}</p>

<form action="{{ route('test.submit', $test) }}" method="post">
    @csrf
    @foreach ($test->questions as $question)
        <label>{{ $question->question_text }}</label><br>
        <input type="text" name="answers[{{ $question->id }}]" required><br><br>
    @endforeach
    <button type="submit">Отправить ответы</button>
</form>
