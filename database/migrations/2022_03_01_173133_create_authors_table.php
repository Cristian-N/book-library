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
            $table->boolean('eastern_order')->nullable();
            $table->string('personal_name', 255)->nullable();
            $table->string('enumeration', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->json('alternate_names')->nullable();
            $table->json('uris')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('death_date')->nullable();
            $table->string('date')->nullable();
            $table->string('wikipedia')->nullable();
            $table->json('links')->nullable();
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
