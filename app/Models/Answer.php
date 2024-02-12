<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'question_id', 'option_id'];

    // Ответ принадлежит к одному вопросу
    public function question()
    {
        return $this->belongsTo(Question::class);
    }


    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
