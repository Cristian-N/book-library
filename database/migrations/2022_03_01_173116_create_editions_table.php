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
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('e_id', 20)->unique()->index();
            $table->string('work_id')->nullable();
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->json('authors')->nullable();
            $table->json('identifiers')->nullable();
            $table->string('publish_date')->nullable();
            $table->string('copyright_date')->nullable();
            $table->string('edition_name')->nullable();
            $table->json('languages')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->json('genres')->nullable();
            $table->json('table_of_contents')->nullable();
            $table->json('series')->nullable();
            $table->string('physical_dimensions', 50)->nullable();
            $table->string('physical_format', 50)->nullable();
            $table->string('number_of_pages', 20)->nullable();
            $table->json('subjects')->nullable();
            $table->json('lccn')->nullable();
            $table->json('isbn_10')->nullable();
            $table->json('isbn_13')->nullable();
            $table->json('contributions')->nullable();
            $table->string('publish_country')->nullable();
            $table->json('publishers')->nullable();
            $table->string('weight')->nullable();
            $table->json('uris')->nullable();
            $table->json('uri_descriptions')->nullable();
            $table->json('volumes')->nullable();
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
        Schema::dropIfExists('editions');
    }
};
