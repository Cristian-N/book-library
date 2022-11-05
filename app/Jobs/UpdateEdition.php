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

class UpdateEdition implements ShouldQueue
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

            DB::table('editions')
                ->where('key', $this->edition['key'])
                ->update(['work_key' => $this->edition['works'][0]['key']]);

        } catch (Error | QueryException | Exception $e) {

            if (!Str::contains($e->getMessage(), 'Duplicate')) {
                Log::info('import failed for edition ' . $this->edition['key'] . ' -- Error: ' . $e->getMessage());
                Log::info($this->edition);
            }
        }
    }
}
