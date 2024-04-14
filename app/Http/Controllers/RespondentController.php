<?php

namespace App\Http\Controllers;

use App\Exports\AnswerExport;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Respondent;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
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

        // Создаем объект для записи Excel
        $writer = WriterEntityFactory::createXLSXWriter();

        // Открываем поток для записи данных
        $writer->openToBrowser('answers.xlsx');

        // Записываем заголовки столбцов
        $writer->addRow(
            WriterEntityFactory::createRow([
                WriterEntityFactory::createCell('Тест'),
                WriterEntityFactory::createCell('Вопрос'),
                WriterEntityFactory::createCell('Ответ'),
                WriterEntityFactory::createCell('Свободный ответ'),
                WriterEntityFactory::createCell('Время ответа'),
            ])
        );

        $chunkSize = 50; // Размер чанка
        $offset = 0;

        do {
            // Читаем данные из базы по чанкам
            $data = Answer::with('test', 'question', 'option')->skip($offset)->take($chunkSize)->get();

            // Если данные не пусты
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    // Добавляем строку в файл Excel
                    $testTitle = $row->test->title;
                    $questionText = $row->question->question_text ?? "";
                    $optionText = $row->option->option_text ?? "";
                    $freeAnswer = $row->free_answer;
                    $createdAt = $row->created_at;

                    // Преобразуем дату в строку в формате "год-месяц-день час:минута:секунда"
                    $formattedDate = $createdAt->format('Y-m-d H:i:s');

                    // Добавляем значения в файл Excel
                    $writer->addRow(
                        WriterEntityFactory::createRow([
                            WriterEntityFactory::createCell($testTitle),
                            WriterEntityFactory::createCell($questionText),
                            WriterEntityFactory::createCell($optionText),
                            WriterEntityFactory::createCell($freeAnswer),
                            WriterEntityFactory::createCell($formattedDate),
                        ])
                    );
                }

                // Увеличиваем смещение
                $offset += $chunkSize;
            }

            // Очищаем буфер вывода перед следующим чанком
            ob_flush();
            flush();
        } while (!$data->isEmpty());

        // Закрываем поток
        $writer->close();

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
