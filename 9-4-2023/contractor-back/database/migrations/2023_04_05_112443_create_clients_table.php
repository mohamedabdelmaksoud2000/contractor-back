<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name_company')->nullable;
            $table->string('type_phone');
            $table->string('phone');
            $table->string('type_email');
            $table->string('email');
            $table->string('link_website')->nullable;
            $table->string('link_facebook')->nullable;
            $table->string('link_twitter')->nullable;
            $table->string('link_youtupe')->nullable;
            $table->string('link_linkedin')->nullable;
            $table->string('address_1');
            $table->string('address_2')->nullable;
            $table->string('country');
            $table->string('governorate');
            $table->string('city');
            $table->string('zip_code');
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
        Schema::dropIfExists('clients');
    }
}