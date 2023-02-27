<?php

namespace App\Jobs;

use Exception;
use GpsLab\Component\Base64UID\Base64UID;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportAuthor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $author;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($author)
    {
        $this->author = $author;
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
            'key' => $this->author['key'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        ! empty($this->author['name']) ? $data['name'] = $this->author['name'] : null;
        ! empty($this->author['personal_name']) ? $data['personal_name'] = $this->author['personal_name'] : null;
        ! empty($this->author['alternate_names']) ? $data['alternate_names'] = implode(',', $this->author['alternate_names']) : null;
        ! empty($this->author['last_modified']['value']) ? $data['last_modified'] = $this->author['last_modified']['value'] : null;

        try {
            DB::table('authors')->insert($data);
        } catch (Exception $e) {
            Log::info('import failed for '.$this->author['key']);
        }
    }
}
