<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> fack()->name(),
            'company_id'=> fack()->name(),
            'profession_id'=> fack()->name(),
            'hourly_salary'=> fack()->name(),
            'monthly_salary'=> fack()->name(),
        ];
    }
}
