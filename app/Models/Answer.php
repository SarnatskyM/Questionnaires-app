<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['respondent_id', 'question_id', 'answer_text'];

    // Ответ принадлежит к одному вопросу
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function respondent(){
        return $this->belongsTo(Respondent::class);
    }
}
