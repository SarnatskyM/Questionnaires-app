<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'slug', 'is_active'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
