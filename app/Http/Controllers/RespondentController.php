<?php

namespace App\Http\Controllers;

use App\Exports\AnswerExport;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Respondent;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class RespondentController extends Controller
{
    // Метод для отображения формы регистрации
    public function showRegistrationForm()
    {
        return view('registration.form');
    }

    public function export()
    {
        // Создаем новый объект класса Xlsx Writer
        $spreadsheet = new Spreadsheet();

        // Отправляем данные в потоковый вывод построчно
        $filename = 'answers.xlsx'; // Имя файла
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Получаем активный лист
        $sheet = $spreadsheet->getActiveSheet();

        // Устанавливаем заголовки столбцов
        $sheet->setCellValue('A1', 'Тест');
        $sheet->setCellValue('B1', 'Вопрос');
        $sheet->setCellValue('C1', 'Ответ');
        $sheet->setCellValue('D1', 'Свободный ответ');
        $sheet->setCellValue('E1', 'Время ответа');

        $chunkSize = 50; // Размер чанка
        $offset = 0;
        do {
            // Читаем данные из базы по чанкам
            $data = Answer::with('test', 'question', 'option')->skip($offset)->take($chunkSize)->get();

            // Если данные не пусты
            if (!$data->isEmpty()) {
                foreach ($data as $index => $row) {
                    $sheet->setCellValue('A' . ($index + $offset + 2), $row->test->title);
                    $sheet->setCellValue('B' . ($index + $offset + 2), $row->question->question_text ?? "");
                    $sheet->setCellValue('C' . ($index + $offset + 2), $row->option->option_text ?? "");
                    $sheet->setCellValue('D' . ($index + $offset + 2), $row->free_answer);
                    $sheet->setCellValue('E' . ($index + $offset + 2), $row->created_at);
                }
                // Увеличиваем смещение
                $offset += $chunkSize;
            }
        } while (!$data->isEmpty());

        $writer = new Xlsx($spreadsheet);
        // Сохраняем файл
        $writer->save('php://output');

        // Завершаем выполнение скрипта
        exit;
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
