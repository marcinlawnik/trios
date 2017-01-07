<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trio;

class ImportTrios extends Command
{
    protected $error = [];
    protected $answers = [];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:txt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import trios from text files';

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
     * @return mixed
     */
    public function handle()
    {
        $this->parseSentences();
        $this->parseAnswers();

        $this->info("Couldn't parse following files: ");
        $this->info(join("\n", $this->error));
    }

    private function parseSentences()
    {
        $files = \File::files(resource_path('trios_sentences'));
        foreach ($files as $file) {
            $this->parseSentencesFile($file);
        }
    }

    private function parseAnswers()
    {
        $files = \File::files(resource_path('trios_answers'));
        foreach ($files as $file) {
            $this->parseAnswersFile($file);
        }
    }

    private function parseSentencesFile($path)
    {
        $file = file_get_contents($path);
        $file = str_replace("\n", "", $file);
        $file = preg_replace("/[\. ]{5,}/", " $$$$$$$$ ", $file);
        $file = preg_replace("/(([l123]\.)|([l123][1]))/", "\n$1", $file);
        $file = preg_replace("/([^\. ])\n(l{1,2}\.)/", "$1$2", $file);

        $matches = preg_match_all("/(([l123]\.)|([l123][1l]))([^\n]+)/", $file, $trios, PREG_SET_ORDER);
        if($matches !== 12) {
            $this->error[] = basename($path);
        }
    }

    private function parseAnswersFile($path)
    {
        $file = file_get_contents($path);
        $matches = preg_match_all("/([A-Z ]{3,})/", $file, $answers, PREG_SET_ORDER);

        foreach ($answers as $answer) {
            $this->answers[] = trim($answer[1]);
        }
    }
}
