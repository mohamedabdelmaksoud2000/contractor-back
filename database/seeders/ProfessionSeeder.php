<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions=[
            [
                'name'=>'superadmin',
                'describe'=>fack()->sentence(),
                'image'=>'url_image',
                'company_id'=>1
            ],
            [
                'name'=>'admin',
                'describe'=>fack()->sentence(),
                'image'=>'url_image',
                'company_id'=>1
            ],
            [
                'name'=>'supervisor',
                'describe'=>fack()->sentence(),
                'image'=>'url_image',
                'company_id'=>1
            ],
            [
                'name'=>'employee',
                'describe'=>fack()->sentence(),
                'image'=>'url_image',
                'company_id'=>1
            ],
        ];

        Profession::insert($professions);
    }
}
