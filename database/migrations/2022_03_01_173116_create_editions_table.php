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
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('e_id', 20)->unique();
            $table->text('title');
            $table->text('subtitle');
            $table->string('title_prefix', 255);
            $table->json('other_titles');
            $table->json('authors');
            $table->string('by_statement');
            $table->string('publish_date');
            $table->string('copyright_date');
            $table->string('edition_name');
            $table->json('languages');
            $table->text('description');
            $table->text('notes');
            $table->json('genres');
            $table->json('table_of_contents');
            $table->json('work_titles');
            $table->json('series');
            $table->string('physical_dimensions', 50);
            $table->string('physical_format', 50);
            $table->string('number_of_pages', 10);
            $table->json('subjects');
            $table->string('pagination');
            $table->json('lccn');
            $table->string('ocaid');
            $table->json('oclc_numbers');
            $table->json('isbn_10');
            $table->json('isbn_13');
            $table->json('dewey_decimal_class');
            $table->json('lc_classifications');
            $table->json('contributions');
            $table->json('publish_places');
            $table->string('publish_country');
            $table->json('publishers');
            $table->json('distributors');
            $table->text('first_sentence');
            $table->string('weight');
            $table->json('location');
            $table->json('collections');
            $table->json('uris');
            $table->json('uri_descriptions');
            $table->string('translation_of');
            $table->json('works');
            $table->json('source_records');
            $table->json('translated_from');
            $table->json('scan_records');
            $table->json('volumes');
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
