<?php

namespace App\Jobs;

use App\Models\Cover;
use App\Models\Subject;
use App\Models\Work;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportWork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $work;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($work)
    {
        $this->work = $work;
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
            Work::insert([
                'w_id' => $this->work->key,
                'title' => $this->work->title,
                'subtitle' => $this->work->subtitle,
                'author' => json_encode($this->work->authors),
                'translated_titles' => json_encode($this->work->translated_titles),
                'subjects' => json_encode($this->work->subjects),
                'subject_places' => json_encode($this->work->subject_places),
                'subject_times' => json_encode($this->work->subject_times),
                'subject_people' => json_encode($this->work->subject_people),
                'dewey_number' => json_encode($this->work->dewey_number),
                'lc_classifications' => json_encode($this->work->lc_classifications),
                'original_languages' => json_encode($this->work->original_languages),
                'other_titles' => json_encode($this->work->other_titles),
                'links' => json_encode($this->work->links),
                'covers' => json_encode($this->work->covers),
                'cover_edition' => $this->work->cover_edition,
                'first_sentence' => $this->work->first_sentence,
                'description' => $this->work->description,
                'notes' => $this->work->notes,
                'created_date' => $this->work->created_date,
                'last_modified' => $this->work->last_modified,
                'first_publish_date' => $this->work->first_publish_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Exception $e) {
            Log::info('Import failed for Work model ' . $this->work->key . ' -- Error: ' . $e->getMessage(), $this->work->toArray());
        }

//        $data = [
//            'uid' => Base64UID::generate(),
//            'key' => $this->work['key'],
//            'title' => !empty($this->work['title']) ? $this->work['title'] : null,
//            'last_modified' => !empty($this->work['last_modified']['value']) ? $this->work['last_modified']['value'] : null,
//            'description' => !empty($this->work['description']) ? json_encode($this->work['description']) : null,
//            'created_at' => now(),
//            'updated_at' => now(),
//        ];
//
//        if (!empty($this->work['description']['value'])) {
//            $data['description'] = $this->work['description']['value'];
//        }
//
//        try {
//            if (!empty($this->work['subjects'])) {
//                foreach ($this->work['subjects'] as $subject) {
//                    Subject::insert([
//                        'uid' => Base64UID::generate(),
//                        'name' => $subject,
//                        'key' => $this->work['key'],
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                }
//            }
//        } catch (\Exception $e) {
//            if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                Log::info('import failed for subjects ' . $this->work['key'] . ' -- Error: ' . $e->getMessage());
//            }
//        }
//
//        try {
//            if (!empty($this->work['authors'])) {
//                foreach ($this->work['authors'] as $author) {
//                    if (!empty($author['author']['key'])) {
//                        DB::table('authors_works')->insert([
//                            'author_id' => $author['author']['key'],
//                            'work_id' => $this->work['key'],
//                            'created_at' => now(),
//                            'updated_at' => now(),
//                        ]);
//                    }
//                }
//            }
//        } catch (\Exception $e) {
//            if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                Log::info('import failed for authors_works ' . $this->work['key'] . ' -- Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
//            }
//        }
//
//        try {
//            DB::table('works')->insert($data);
//        } catch (\Exception $e) {
//            if (!Str::contains($e->getMessage(), 'Duplicate')) {
//                Log::info('import failed for work ' . $this->work['key'] . ' -- Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
//            }
//        }
    }
}
