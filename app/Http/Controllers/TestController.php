<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Answer;

class TestController extends Controller
{
    // Метод для отображения списка доступных тестов
    public function index()
    {
        $tests = Test::all();
        return view('tests.index', compact('tests'));
    }

    // Метод для отображения конкретного теста
    public function show(Test $test)
    {
        return view('tests.show', compact('test'));
    }

    // Метод для отправки ответов на тест
    public function submit(Request $request, Test $test)
    {
        // Проверка и сохранение ответов
        foreach ($request->input('answers') as $question_id => $answer_text) {
            $answer = new Answer();
            $answer->respondent_id = auth()->id(); // Если авторизация не требуется, замените на соответствующий идентификатор респондента
            $answer->question_id = $question_id;
            $answer->answer_text = $answer_text;
            $answer->save();
        }

        // Редирект после отправки ответов
        return redirect()->route('tests.index')->with('success', 'Ваши ответы успешно отправлены!');
    }
}
