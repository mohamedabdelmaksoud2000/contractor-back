<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fack()->name(),
            'describe'=> fack()->sentence(),
            'budget'=> fack()->randomNumber(5, true),
            'image'=> fack()->image(null, 640, 480),
            'supervisor_id'=> fack()->unique()->randomDigit(),
            'start_time'=> fack()->time(),
            'end_time'=> fack()->time(),
            'client_id'=> fack()->unique()->randomDigit(),
            'company_id'=>1
        ];
    }
}
