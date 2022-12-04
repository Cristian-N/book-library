<?php

namespace App\Jobs;

use App\Models\Edition;
use App\Models\Identifier;
use App\Models\Publisher;
use App\Models\Subject;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportEdition implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $edition;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($edition)
    {
        $this->edition = $edition;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::disableQueryLog();

        try {
            Edition::insert([
                'e_id' => $this->edition->key,
                'work_id' => $this->edition->work_id,
                'title' => (strlen($this->edition->title) > 200) ? substr($this->edition->title  , 0, 200) . '...' : $this->edition->title,
                'subtitle' => $this->edition->subtitle,
                'title_prefix' => $this->edition->title_prefix,
                'other_titles' => json_encode($this->edition->other_titles),
                'authors' => json_encode($this->edition->authors),
                'identifiers' => json_encode($this->edition->identifiers),
                'by_statement' => $this->edition->by_statement,
                'publish_date' => $this->edition->publish_date,
                'copyright_date' => $this->edition->copyright_date,
                'edition_name' => $this->edition->edition_name,
                'languages' => json_encode($this->edition->languages),
                'description' => $this->edition->description,
                'notes' => $this->edition->notes,
                'genres' => json_encode($this->edition->genres),
                'table_of_contents' => json_encode($this->edition->table_of_contents),
                'work_titles' => json_encode($this->edition->work_titles),
                'series' => json_encode($this->edition->series),
                'physical_dimensions' => $this->edition->physical_dimensions,
                'physical_format' => $this->edition->physical_format,
                'number_of_pages' => $this->edition->number_of_pages,
                'subjects' => json_encode($this->edition->subjects),
                'pagination' => $this->edition->pagination,
                'lccn' => json_encode($this->edition->lccn),
                'ocaid' => $this->edition->ocaid,
                'oclc_numbers' => json_encode($this->edition->oclc_numbers),
                'isbn_10' => json_encode($this->edition->isbn_10),
                'isbn_13' => json_encode($this->edition->isbn_13),
                'dewey_decimal_class' => json_encode($this->edition->dewey_decimal_class),
                'lc_classifications' => json_encode($this->edition->lc_classifications),
                'contributions' => json_encode($this->edition->contributions),
                'publish_places' => json_encode($this->edition->publish_places),
                'publish_country' => $this->edition->publish_country,
                'publishers' => json_encode($this->edition->publishers),
                'distributors' => json_encode($this->edition->distributors),
                'first_sentence' => $this->edition->first_sentence,
                'weight' => $this->edition->weight,
                'location' => json_encode($this->edition->location),
                'collections' => json_encode($this->edition->collections),
                'uris' => json_encode($this->edition->uris),
                'uri_descriptions' => json_encode($this->edition->uri_descriptions),
                'translation_of' => $this->edition->translation_of,
                'works' => json_encode($this->edition->works),
                'source_records' => json_encode($this->edition->source_records),
                'translated_from' => json_encode($this->edition->translated_from),
                'scan_records' => json_encode($this->edition->scan_records),
                'volumes' => json_encode($this->edition->volumes),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Exception $e) {
            Log::info('Import failed for Edition model ' . $this->edition->key . ' -- Error: ' . $e->getMessage(), $this->edition->toArray());
        }

//        if (
//            is_null($data['number_of_pages'])
//            && !empty($this->edition['pagination'])
//        ) {
//            $data['number_of_pages'] = (int)$this->edition['pagination'];
//        }
//
//        if (!empty($this->edition['full_title'])) {
//            $data['subtitle'] = !is_null($data['subtitle']) ? $this->edition['full_title'] . ' - ' . $data['subtitle'] : $this->edition['full_title'];
//        }
//
//        if (!empty($this->edition['description']['value'])) {
//            $data['description'] = $this->edition['description']['value'];
//        }
//
//        try {
//            DB::table('editions')->insert($data);
//        } catch (Error | QueryException | Exception $e) {
//            if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                Log::info('import failed for edition ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                Log::info($data);
//            }
//        }
//
//        if (!empty($this->edition['subjects'])) {
//            foreach ($this->edition['subjects'] as $subject) {
//                try {
//                    Subject::create([
//                        'uid' => Base64UID::generate(),
//                        'name' => $subject,
//                        'key' => $this->edition['key'],
//                    ]);
//                } catch (Exception $e) {
//                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                        Log::info('import failed for subject ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                    }
//                }
//            }
//        }
//
//        if (!empty($this->edition['publishers'])) {
//            foreach ($this->edition['publishers'] as $publisher) {
//                try {
//                    Publisher::create([
//                        'uid' => Base64UID::generate(),
//                        'name' => $publisher,
//                        'key' => $this->edition['key'],
//                    ]);
//                } catch (Exception $e) {
//                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                        Log::info('import failed for publisher ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                    }
//                }
//
//            }
//        }
//
//        if (!empty($this->edition['identifiers'])) {
//            foreach ($this->edition['identifiers'] as $identifier) {
//                try {
//                    Identifier::create([
//                        'uid' => Base64UID::generate(),
//                        'name' => json_encode($identifier),
//                        'key' => $this->edition['key'],
//                    ]);
//                } catch (Exception $e) {
//                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                        Log::info('import failed for identifier ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                    }
//                }
//            }
//        }
//
//        if (!empty($this->edition['languages'])) {
//            foreach ($this->edition['languages'] as $language) {
//                try {
//                    DB::table('languages')->insert([
//                        'uid' => Base64UID::generate(),
//                        'name' => Str::of($language['key'])->replace('/languages/', ''),
//                        'key' => $this->edition['key'],
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                } catch (Exception $e) {
//                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                        Log::info('import failed for language ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                    }
//                }
//            }
//        }
//
//        if (!empty($this->edition['series'])) {
//            try {
//                DB::table('series')->insert([
//                    'uid' => Base64UID::generate(),
//                    'name' => implode(' - ', $this->edition['series']),
//                    'key' => $this->edition['key'],
//                    'created_at' => now(),
//                    'updated_at' => now(),
//                ]);
//            } catch (Exception $e) {
//                if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                    Log::info('import failed for series ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                }
//            }
//        }
//
//        if (!empty($this->edition['authors'])) {
//            foreach ($this->edition['authors'] as $author) {
//                try {
//                    DB::table('authors_editions')->insert([
//                        'author_id' => $author['key'],
//                        'edition_id' => $this->edition['key'],
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                } catch (Exception $e) {
//                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                        Log::info('import failed for authors_editions ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                    }
//                }
//
//            }
//        }
//
//        if (!empty($this->edition['works'])) {
//            foreach ($this->edition['works'] as $work) {
//                try {
//                    DB::table('editions_works')->insert([
//                        'work_id' => $work['key'],
//                        'edition_id' => $this->edition['key'],
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                } catch (Exception $e) {
//                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                        Log::info('import failed for editions_works ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
//                    }
//                }
//
//            }
//        }
    }
}
