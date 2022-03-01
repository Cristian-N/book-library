<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('a_id', 20)->unique();
            $table->string('name', 255);
            $table->boolean('eastern_order');
            $table->string('personal_name', 255);
            $table->string('enumeration', 255);
            $table->string('title', 255);
            $table->json('alternate_names');
            $table->json('uris');
            $table->text('bio');
            $table->string('location');
            $table->string('birth_date');
            $table->string('death_date');
            $table->string('date');
            $table->string('wikipedia');
            $table->json('links');
            $table->softDeletes();
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
        Schema::dropIfExists('authors');
    }
};
