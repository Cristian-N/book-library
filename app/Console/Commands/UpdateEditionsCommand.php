<?php

namespace App\Console\Commands;

use App\Http\DTO\EditionUpdateData;
use App\Jobs\UpdateEdition;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use TypeError;

class UpdateEditionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:editions';

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

        $this->info(PHP_EOL . now() . ' Processing editions ...' . PHP_EOL);

        $path = base_path('storage/app/private');
        $files = collect(File::allFiles($path));

        $files
            ->skip(0)
            ->take(10)
            ->each(function ($file) {
                $this->info('Processing file ' . $file->getFilename() . ' ...' . PHP_EOL);

                $this->output->progressStart(100000);

                LazyCollection::make(function () use ($file) {
                    $handle = fopen($file->getPathname(), 'r');

                    while (($line = fgets($handle)) !== false) {
                        yield $line;
                    }
                })
//                ->skip(0)
//                ->take(100)
                ->each(function ($line) {
                    $line = preg_split("/[\t]/", $line);

                    $item = json_decode($line[4], true);

                    try {
                        if (isset($item['key'])) {
                            $edition = $this->initializeEditionData($item);

                            UpdateEdition::dispatch($edition);
                        }
                    } catch (TypeError $e) {
                        Log::error('Could not initialize EditionUpdateData DTO ' . $e->getMessage(), $item);
                    }

                    $this->output->progressAdvance();
                });

                $this->output->progressFinish();

                $this->info('Processing done for file: ' . $file->getFilename() . PHP_EOL);
            });

        $time_end = microtime(true);

        $execution_time = ($time_end - $time_start) / 60;

        $this->info(now() . ' - Execution time: ' . $execution_time . PHP_EOL);

        dd('IMPORTED');
    }

    private function initializeEditionData(mixed $item): EditionUpdateData
    {
        return new EditionUpdateData(
            $item['key'],
            isset($item['authors']) ? Arr::map($item['authors'], function ($value, $key) {
                return $value['key'] ?? null;
            }) : null,
            isset($item['languages']) ? Arr::map($item['languages'], function ($value, $key) {
                return $value['key'] ?? null;
            }) : null,
            isset($item['works']) ? Arr::map($item['works'], function ($value, $key) {
                return $value['key'] ?? null;
            }) : null,
        );
    }
}
