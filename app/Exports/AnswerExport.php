<?php

namespace App\Exports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnswerExport implements FromCollection
{
    /**
     * @var int Размер каждой части
     */
    protected $chunkSize;

    /**
     * Создать новый экспорт данных.
     *
     * @param int $chunkSize Размер каждой части
     */
    public function __construct($chunkSize = 1000)
    {
        $this->chunkSize = $chunkSize;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Answer::chunk($this->chunkSize, function ($answers) {
            foreach ($answers as $answer) {
                yield $answer;
            }
        });
    }
}
