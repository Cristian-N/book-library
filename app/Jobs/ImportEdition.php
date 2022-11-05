<?php

namespace App\Jobs;

use App\Models\Identifier;
use App\Models\Publisher;
use App\Models\Subject;
use Carbon\Carbon;
use Error;
use Exception;
use GpsLab\Component\Base64UID\Base64UID;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

        $data = [
            'uid' => Base64UID::generate(),
            'key' => $this->edition['key'],
            'title' => (strlen($this->edition['title']) > 200) ? substr($this->edition['title'], 0, 200) : $this->edition['title'],
            'subtitle' => !empty($this->edition['subtitle']) ? $this->edition['subtitle'] : null,
            'edition_name' => !empty($this->edition['edition_name']) ? $this->edition['edition_name'] : null,
            'physical_format' => !empty($this->edition['physical_format']) ? $this->edition['physical_format'] : null,
            'isbn_13' => !empty($this->edition['isbn_13']) ? implode(',', $this->edition['isbn_13']) : null,
            'isbn_10' => !empty($this->edition['isbn_10']) ? implode(',', $this->edition['isbn_10']) : null,
            'oclc_numbers' => !empty($this->edition['oclc_numbers']) ? implode(',', $this->edition['oclc_numbers']) : null,
            'lccn' => !empty($this->edition['lccn']) ? implode(',', $this->edition['lccn']) : null,
            'number_of_pages' => !empty($this->edition['number_of_pages']) ? $this->edition['number_of_pages'] : null,
            'physical_dimensions' => !empty($this->edition['physical_dimensions']) ? $this->edition['physical_dimensions'] : null,
            'description' => !empty($this->edition['description']) ? json_encode($this->edition['description']) : null,
            'publish_date' => !empty($this->edition['publish_date']) ? $this->edition['publish_date'] : null,
            'last_modified' => $this->edition['last_modified']['value'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (
            is_null($data['number_of_pages'])
            && !empty($this->edition['pagination'])
        ) {
            $data['number_of_pages'] = (int)$this->edition['pagination'];
        }

        if (!empty($this->edition['full_title'])) {
            $data['subtitle'] = !is_null($data['subtitle']) ? $this->edition['full_title'] . ' - ' . $data['subtitle'] : $this->edition['full_title'];
        }

        if (!empty($this->edition['description']['value'])) {
            $data['description'] = $this->edition['description']['value'];
        }

        try {
            DB::table('editions')->insert($data);
        } catch (Error | QueryException | Exception $e) {
            if (!Str::contains($e->getMessage(), 'Duplicate')) {
                Log::info('import failed for edition ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                Log::info($data);
            }
        }

        if (!empty($this->edition['subjects'])) {
            foreach ($this->edition['subjects'] as $subject) {
                try {
                    Subject::create([
                        'uid' => Base64UID::generate(),
                        'name' => $subject,
                        'key' => $this->edition['key'],
                    ]);
                } catch (Exception $e) {
                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
                        Log::info('import failed for subject ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                    }
                }
            }
        }

        if (!empty($this->edition['publishers'])) {
            foreach ($this->edition['publishers'] as $publisher) {
                try {
                    Publisher::create([
                        'uid' => Base64UID::generate(),
                        'name' => $publisher,
                        'key' => $this->edition['key'],
                    ]);
                } catch (Exception $e) {
                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
                        Log::info('import failed for publisher ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                    }
                }

            }
        }

        if (!empty($this->edition['identifiers'])) {
            foreach ($this->edition['identifiers'] as $identifier) {
                try {
                    Identifier::create([
                        'uid' => Base64UID::generate(),
                        'name' => json_encode($identifier),
                        'key' => $this->edition['key'],
                    ]);
                } catch (Exception $e) {
                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
                        Log::info('import failed for identifier ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                    }
                }
            }
        }

        if (!empty($this->edition['languages'])) {
            foreach ($this->edition['languages'] as $language) {
                try {
                    DB::table('languages')->insert([
                        'uid' => Base64UID::generate(),
                        'name' => Str::of($language['key'])->replace('/languages/', ''),
                        'key' => $this->edition['key'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } catch (Exception $e) {
                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
                        Log::info('import failed for language ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                    }
                }
            }
        }

        if (!empty($this->edition['series'])) {
            try {
                DB::table('series')->insert([
                    'uid' => Base64UID::generate(),
                    'name' => implode(' - ', $this->edition['series']),
                    'key' => $this->edition['key'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (Exception $e) {
                if (!Str::contains($e->getMessage(), 'Duplicate')) {
                    Log::info('import failed for series ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                }
            }
        }

        if (!empty($this->edition['authors'])) {
            foreach ($this->edition['authors'] as $author) {
                try {
                    DB::table('authors_editions')->insert([
                        'author_id' => $author['key'],
                        'edition_id' => $this->edition['key'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } catch (Exception $e) {
                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
                        Log::info('import failed for authors_editions ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                    }
                }

            }
        }

        if (!empty($this->edition['works'])) {
            foreach ($this->edition['works'] as $work) {
                try {
                    DB::table('editions_works')->insert([
                        'work_id' => $work['key'],
                        'edition_id' => $this->edition['key'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } catch (Exception $e) {
                    if (!Str::contains($e->getMessage(), 'Duplicate')) {
                        Log::info('import failed for editions_works ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                    }
                }

            }
        }
    }
}
