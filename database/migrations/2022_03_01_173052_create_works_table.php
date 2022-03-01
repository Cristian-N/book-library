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
        Schema::create('works', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('w_id', 20)->unique();
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->json('authors')->nullable();
            $table->json('translated_titles')->nullable();
            $table->json('subjects')->nullable();
            $table->json('subject_places')->nullable();
            $table->json('subject_times')->nullable();
            $table->json('subject_people')->nullable();
            $table->json('dewey_number')->nullable();
            $table->json('lc_classifications')->nullable();
            $table->json('original_languages')->nullable();
            $table->json('other_titles')->nullable();
            $table->json('links')->nullable();
            $table->json('covers')->nullable();
            $table->string('cover_edition', 50)->nullable();
            $table->text('first_sentence')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('first_publish_date', 20)->nullable();
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
        Schema::dropIfExists('works');
    }
};
