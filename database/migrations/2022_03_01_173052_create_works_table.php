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
            $table->id();
            $table->string('w_id', 35)->unique()->index();
            $table->text('title');
            $table->json('author')->nullable();
            $table->json('subjects')->nullable();
            $table->json('subject_places')->nullable();
            $table->json('links')->nullable();
            $table->json('covers')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('created_date', 50)->nullable();
            $table->string('last_modified', 50)->nullable();
            $table->string('first_publish_date', 50)->nullable();
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
