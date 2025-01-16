<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Respondent;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;


class RespondentController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration.form');
    }

    public function export()
    {

        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToBrowser('answers.xlsx');
        $writer->addRow(
            WriterEntityFactory::createRow([
                WriterEntityFactory::createCell('Тест'),
                WriterEntityFactory::createCell('Вопрос'),
                WriterEntityFactory::createCell('Ответ'),
                WriterEntityFactory::createCell('Свободный ответ'),
                WriterEntityFactory::createCell('Время ответа'),
            ])
        );

        $chunkSize = 300; 
        $offset = 0;

        do {
            $data = Answer::with('test', 'question', 'option')->skip($offset)->take($chunkSize)->get();

            // Если данные не пусты
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $testTitle = $row->test->title;
                    $questionText = $row->question->question_text ?? "";
                    $optionText = $row->option->option_text ?? "";
                    $freeAnswer = $row->free_answer;
                    $createdAt = $row->created_at;

                    $formattedDate = $createdAt->format('Y-m-d H:i:s');

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

                $offset += $chunkSize;
            }

            ob_flush();
            flush();
        } while (!$data->isEmpty());

        // Закрываем поток
        $writer->close();

        exit;
        return view('tests.export');
    }

    // Метод для обработки данных регистрации
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:respondents,email',
        ]);

        $respondent = Respondent::create($validatedData);

        return redirect()->route('tests.index')->with('success', 'Вы успешно зарегистрированы!');
    }
}
