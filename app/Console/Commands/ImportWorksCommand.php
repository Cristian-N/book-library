<?php

namespace App\Console\Commands;

use App\Http\DTO\WorkData;
use App\Jobs\ImportWork;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use TypeError;

class ImportWorksCommand extends Command
{

    private $idsFromFile;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:works';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $time_start = microtime(true);

        $this->info(PHP_EOL . now() . ' Processing works ...' . PHP_EOL);

        $path = base_path('storage/app/private');
        $files = collect(File::allFiles($path));

        $files
            ->skip(1)
            ->take(1)
            ->each(function($file) {
                $this->info('Processing file ' . $file->getFilename() . ' ...' . PHP_EOL);

                $this->output->progressStart(100000);

                LazyCollection::make(function () use ($file) {
                    $handle = fopen($file->getPathname(), 'r');

                    while (($line = fgets($handle)) !== false) {
                        yield $line;
                    }
                })
                ->skip(1)
                ->take(1)
                ->each(function ($line) {
                    $line = preg_split("/[\t]/", $line);

                    $workJSON = json_decode($line[4], true);

                    try {
                        $work = $this->initializeWorkData($workJSON);

                        ImportWork::dispatch($work);
                    } catch (TypeError $e) {
                        Log::error('Could not initialize WorkData DTO', $workJSON);
                    }

                    $this->output->progressAdvance();
                });

                $this->output->progressFinish();

                $this->info('Processing done for file: ' . $file->getFilename() . PHP_EOL);
            });

        $time_end = microtime(true);

        $execution_time = ($time_end - $time_start)/60;

        $this->info(now() . ' - Execution time: ' . $execution_time . PHP_EOL);

        dd('IMPORTED');
    }

    private function initializeWorkData($work): WorkData
    {
        $authors = isset($work['authors']) ? Arr::map($work['authors'], function ($value, $key) {
            return $value['author']['key'] ?? null;
        }) : null;

        return new WorkData(
            $work['key'] ?? null,
            $work['title'] ?? null,
            $work['subtitle'] ?? null,
            $authors ?? null,
            $work['translated_titles'] ?? null,
            $work['subjects'] ?? null,
            $work['subject_places'] ?? null,
            $work['subject_times'] ?? null,
            $work['subject_people'] ?? null,
            $work['dewey_number'] ?? null,
            $work['lc_classifications'] ?? null,
            $work['original_languages'] ?? null,
            $work['other_titles'] ?? null,
            $work['links'] ?? null,
            $work['covers'] ?? null,
            $work['cover_edition']['key'] ?? null,
            $work['first_sentence']['value'] ?? null,
            $work['description']['value'] ?? null,
            $work['notes'] ?? null,
            $work['first_publish_date'] ?? null,
            $work['created']['value'] ?? null,
            $work['last_modified']['value'] ?? null,
        );
    }
}
