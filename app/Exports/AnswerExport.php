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
        return Answer::with('question', 'test', 'option')
            ->get();
    }

    public function chunkSize(): int
    {
        return $this->chunkSize;
    }
}
