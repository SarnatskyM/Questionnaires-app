<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respondent;

class RespondentController extends Controller
{
    // Метод для отображения формы регистрации
    public function showRegistrationForm()
    {
        return view('registration.form');
    }

    // Метод для обработки данных регистрации
    public function register(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:respondents,email',
        ]);

        // Создание нового респондента
        $respondent = Respondent::create($validatedData);

        // Редирект после успешной регистрации
        return redirect()->route('tests.index')->with('success', 'Вы успешно зарегистрированы!');
    }
}
