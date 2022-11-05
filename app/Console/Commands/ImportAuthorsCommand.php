<?php

namespace App\Console\Commands;

use App\Jobs\ImportAuthor;
use Exception;
use GpsLab\Component\Base64UID\Base64UID;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\LazyCollection;

class ImportAuthorsCommand extends Command
{
    private $fileIsProcessed = [];
    private $idsFromFile = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:authors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import authors from archive';

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

        $this->info(now() . ' Processing authors ...');

        $path = base_path('storage/app/public/authors');
        $files = collect(File::allFiles($path));

        $files
            ->skip(70)
            ->take(10)
            ->each(function($file) {
                $this->info('Processing file ' . $file->getFilename() . ' ...' . PHP_EOL);

                $this->output->progressStart(100000);

                LazyCollection::make(function () use ($file) {
                    $handle = fopen($file->getPathname(), 'r');

                    while (($line = fgets($handle)) !== false) {
                        yield $line;
                    }
                })->each(function ($line) use ($file) {
                    $item = preg_split("/[\t]/", $line);

                    $author = json_decode($item[4], true);

                    ImportAuthor::dispatch($author);

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
}
