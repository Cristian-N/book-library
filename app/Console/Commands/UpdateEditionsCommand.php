<?php

namespace App\Console\Commands;

use App\Jobs\ImportEdition;
use App\Jobs\ImportWork;
use App\Jobs\UpdateEdition;
use App\Models\Cover;
use App\Models\Edition;
use App\Models\Identifier;
use App\Models\Publisher;
use App\Models\Subject;
use App\Models\Work;
use Carbon\Carbon;
use GpsLab\Component\Base64UID\Base64UID;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

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

        $path = base_path('storage/app/public/editions');
        $files = collect(File::allFiles($path));

        $files
            ->skip(310)
            ->take(40)
            ->each(function ($file) {
                $this->info('Processing file ' . $file->getFilename() . ' ...' . PHP_EOL);

                $this->output->progressStart(100000);

                LazyCollection::make(function () use ($file) {
                    $handle = fopen($file->getPathname(), 'r');

                    while (($line = fgets($handle)) !== false) {
                        yield $line;
                    }
                })->each(function ($line) {
                    $line = preg_split("/[\t]/", $line);

                    $item = json_decode($line[4], true);

                    if (
                        !empty($item['key'])
                        && !empty($item['works'][0]['key'])
                    ) {
                        UpdateEdition::dispatch($item);
                    } else {
                        // Log::info($item);
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
}
