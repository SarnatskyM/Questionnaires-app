<?php

namespace App\Exports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnswerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Answer::with('question', 'test', 'option')->get();
    }
}
