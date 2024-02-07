<?php

namespace Database\Factories;

use App\Models\Respondent;
use Illuminate\Database\Eloquent\Factories\Factory;

class RespondentFactory extends Factory
{
    protected $model = Respondent::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
