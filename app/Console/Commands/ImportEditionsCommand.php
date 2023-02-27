<?php

namespace App\Console\Commands;

use App\Http\DTO\EditionData;
use App\Jobs\ImportEdition;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use TypeError;

class ImportEditionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:editions';

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

        $this->info(PHP_EOL.now().' Processing editions ...'.PHP_EOL);

        $path = base_path('storage/app/private');
        $files = collect(File::allFiles($path));

        $files
            ->skip(5)
            ->take(1)
            ->each(function ($file) {
                $this->info('Processing file '.$file->getFilename().' ...'.PHP_EOL);

                $this->output->progressStart(100000);

                LazyCollection::make(function () use ($file) {
                    $handle = fopen($file->getPathname(), 'r');

                    while (($line = fgets($handle)) !== false) {
                        yield $line;
                    }
                })
                ->skip(0)
                ->take(10000)
                ->each(function ($line) {
                    $line = preg_split("/[\t]/", $line);

                    $item = json_decode($line[4], true);

                    try {
                        if (isset($item['title'])) {
                            $edition = $this->initializeEditionData($item);

                            ImportEdition::dispatch($edition);
                        }
                    } catch (TypeError $e) {
                        Log::error('Could not initialize EditionData DTO '.$e->getMessage(), $item);
                    }

                    $this->output->progressAdvance();
                });

                $this->output->progressFinish();

                $this->info('Processing done for file: '.$file->getFilename().PHP_EOL);
            });

        $time_end = microtime(true);

        $execution_time = ($time_end - $time_start) / 60;

        $this->info(now().' - Execution time: '.$execution_time.PHP_EOL);

        dd('IMPORTED');
    }

    private function initializeEditionData(mixed $item): EditionData
    {
        return new EditionData(
            $item['key'] ?? null,
            $item['works'][0]['key'] ?? null,
            $item['title'] ?? null,
            $item['subtitle'] ?? null,
            $item['title_prefix'] ?? null,
            $item['other_titles'] ?? null,
            isset($item['authors']) ? Arr::map($item['authors'], function ($value, $key) {
                return $value['author']['key'] ?? null;
            }) : null,
            $item['identifiers'] ?? null,
            $item['by_statement'] ?? null,
            $item['publish_date'] ?? null,
            $item['copyright_date'] ?? null,
            $item['edition_name'] ?? null,
            isset($item['languages']) ? Arr::map($item['languages'], function ($value, $key) {
                return $value['languages']['key'] ?? null;
            }) : null,
            $item['description']['value'] ?? null,
            $item['notes']['value'] ?? null,
            $item['genres'] ?? null,
            $item['table_of_contents'] ?? null,
            $item['work_titles'] ?? null,
            $item['series'] ?? null,
            $item['physical_dimensions'] ?? null,
            $item['physical_format'] ?? null,
            $item['number_of_pages'] ?? null,
            $item['subjects'] ?? null,
            $item['pagination'] ?? null,
            $item['lccn'] ?? null,
            $item['ocaid'] ?? null,
            $item['oclc_numbers'] ?? null,
            $item['isbn_10'] ?? null,
            $item['isbn_13'] ?? null,
            $item['dewey_decimal_class'] ?? null,
            $item['lc_classifications'] ?? null,
            $item['contributions'] ?? null,
            $item['publish_places'] ?? null,
            $item['publish_country'] ?? null,
            $item['publishers'] ?? null,
            $item['distributors'] ?? null,
            $item['first_sentence']['value'] ?? null,
            $item['weight'] ?? null,
            $item['location'] ?? null,
            $item['collections'] ?? null,
            $item['uris'] ?? null,
            $item['uri_descriptions'] ?? null,
            $item['translation_of'] ?? null,
            isset($item['works']) ? Arr::map($item['works'], function ($value, $key) {
                return $value['works']['key'] ?? null;
            }) : null,
            $item['source_records'] ?? null,
            $item['translated_from'] ?? null,
            $item['scan_records'] ?? null,
            $item['volumes'] ?? null,
        );
    }
}
