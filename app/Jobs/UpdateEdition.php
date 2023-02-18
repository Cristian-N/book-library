<?php

namespace App\Jobs;

use App\Http\DTO\EditionUpdateData;
use Error;
use Exception;
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

    private EditionUpdateData $edition;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EditionUpdateData $edition)
    {
        $this->edition = $edition;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::disableQueryLog();

        try {
            DB::table('editions')
                ->where('e_id', $this->edition->key)
                ->update([
                    'authors' => json_encode($this->edition->authors),
                    'languages' => json_encode($this->edition->languages),
                ]);
        } catch (Error | QueryException | Exception $e) {
            Log::info('Update failed for Edition ' . $this->edition->key . ' -- Error: ' . $e->getMessage(), $this->edition->toArray());
        }
    }
}
