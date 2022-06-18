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
            $table->string('work_id');
            $table->string('e_id', 20)->unique()->index();
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->string('title_prefix', 255)->nullable();
            $table->json('other_titles')->nullable();
            $table->json('authors')->nullable();
            $table->string('by_statement')->nullable();
            $table->string('publish_date')->nullable();
            $table->string('copyright_date')->nullable();
            $table->string('edition_name')->nullable();
            $table->json('languages')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->json('genres')->nullable();
            $table->json('table_of_contents')->nullable();
            $table->json('work_titles')->nullable();
            $table->json('series')->nullable();
            $table->string('physical_dimensions', 50)->nullable();
            $table->string('physical_format', 50)->nullable();
            $table->string('number_of_pages', 20)->nullable();
            $table->json('subjects')->nullable();
            $table->string('pagination')->nullable();
            $table->json('lccn')->nullable();
            $table->string('ocaid')->nullable();
            $table->json('oclc_numbers')->nullable();
            $table->json('isbn_10')->nullable();
            $table->json('isbn_13')->nullable();
            $table->json('dewey_decimal_class')->nullable();
            $table->json('lc_classifications')->nullable();
            $table->json('contributions')->nullable();
            $table->json('publish_places')->nullable();
            $table->string('publish_country')->nullable();
            $table->json('publishers')->nullable();
            $table->json('distributors')->nullable();
            $table->text('first_sentence')->nullable();
            $table->string('weight')->nullable();
            $table->json('location')->nullable();
            $table->json('collections')->nullable();
            $table->json('uris')->nullable();
            $table->json('uri_descriptions')->nullable();
            $table->string('translation_of')->nullable();
            $table->json('works')->nullable();
            $table->json('source_records')->nullable();
            $table->json('translated_from')->nullable();
            $table->json('scan_records')->nullable();
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
