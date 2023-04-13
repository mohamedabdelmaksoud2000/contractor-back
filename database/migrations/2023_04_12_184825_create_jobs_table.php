<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2023_04_05_134230_create_professions_table.php
            $table->string('name');
            $table->text('describe');
            $table->string('image');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
=======
            
            $table->timestamps();
>>>>>>> b1a7ef6a014815b7db3e9c25be8395b5c0528430:database/migrations/2023_04_12_184825_create_jobs_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
