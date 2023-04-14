<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('describe');
            $table->double('budget');
            $table->string('image');
            $table->unsignedBigInteger('supervisor_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_teams');
    }
}
