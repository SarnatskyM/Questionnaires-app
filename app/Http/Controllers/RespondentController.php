<?php

namespace App\Http\Controllers;

use App\Exports\AnswerExport;
use Illuminate\Http\Request;
use App\Models\Respondent;
use Maatwebsite\Excel\Facades\Excel;


class RespondentController extends Controller
{
    // Метод для отображения формы регистрации
    public function showRegistrationForm()
    {
        return view('registration.form');
    }

    public function export()
    {
        $export = new AnswerExport(500);
        return Excel::download($export, 'answer.xlsx');
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
