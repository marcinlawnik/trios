<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Trio;

class ImportJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import trios from JSON file.';

    private $inputDirectory;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->inputDirectory = storage_path('app\trios');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = File::allFiles($this->inputDirectory);
        foreach ($files as $file)
        {
            $this->info('Processing file: ' . $file);
            $fileContent = File::get((string)$file);
            $fileContentDecoded = json_decode($fileContent, true);
            foreach ($fileContentDecoded['trios'] as $trio) {
                $newTrio = new Trio();
                $newTrio->sentence1 = $trio['sentence1'];
                $newTrio->sentence2 = $trio['sentence2'];
                $newTrio->sentence3 = $trio['sentence3'];
                $newTrio->explanation1 = $trio['explanation1'];
                $newTrio->explanation2 = $trio['explanation2'];
                $newTrio->explanation3 = $trio['explanation3'];
                $newTrio->answer = $trio['answer'];
                $newTrio->save();
            }
        }
    }
}
