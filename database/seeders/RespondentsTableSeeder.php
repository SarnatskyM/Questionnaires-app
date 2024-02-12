<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Respondent;

class RespondentsTableSeeder extends Seeder
{
    public function run()
    {
        Respondent::factory()->count(10)->create();
    }
}

