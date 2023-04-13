<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
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
            'logo' => fack()->image(null, 640, 480),
            'email' => fack()->email(),
            'phone' => fack()->phoneNumber(),
            'link_website' => fack()->url(),
            'link_facebook' => fack()->freeEmail(),
            'link_twitter' => fack()->freeEmail(),
            'link_youtube' => fack()->freeEmail(),
            'link_linkedin' => fack()->freeEmail(),
            'address_1' => fack()->address(),
            'address_2' => fack()->address(),
            'country' => fack()->country(),
            'governorate' => fack()->governorate(),
            'city' => fack()->state(),
            'zip_code' => fack()->state(),
            'user_id' => fack()->postcode(),
        ];
    }
}
