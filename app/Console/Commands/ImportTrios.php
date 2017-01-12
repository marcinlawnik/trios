<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trio;

class ImportTrios extends Command
{
    protected $error = [];
    protected $answers = [];
    protected $currentAnswer = 0;
    protected $emptyFieldString = '$@$';

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
        $this->parseAnswers();
        $this->parseSentences();

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
        // Usuwam znaki nowych lini - pomocne pozniej
        $file = str_replace("\n", "", $file);
        // Zamieniam kropki na podany znak
        $file = preg_replace("/[\. ]{5,}/", " $this->emptyFieldString ", $file);
        // Dodaje znak nowej linii przed każdym zdaniem, tj. przed '1.' '2.' '3.' + mała korekta bledow OCR (np. 'l.')
        // nie działa jeśli OCR zjadł kropkę
        $file = preg_replace("/(([l123]\.)|([l123][1]))/", "\n$1", $file);
        // korekta błedu traktuje literę l na końcu zdania jako licznik przed nowym, ten regexpr to naprawia
        $file = preg_replace("/([^\. ])\n(l{1,2}\.)/", "$1$2", $file);

        // odczytanie zdania
        $matches = preg_match_all("/(([l123]\.)|([l123][1l]))([^\n]+)/", $file, $trios, PREG_SET_ORDER);

        // Jeśli liczba zdań na stronie się nie zgadza to ignoruje wszystkie trios z tej strony
        if($matches !== 12) {
            $this->error[] = basename($path);
            $this->currentAnswer += 4;
        } else {
            // W przeciwnym wypadku dodaje do bazy danych
            for($i = 0; $i < 4; $i++) {
                $newTrio = new Trio();
                $newTrio->sentence1 = trim($trios[$i * 3][4]);
                $newTrio->sentence2 = trim($trios[$i * 3 + 1][4]);
                $newTrio->sentence3 = trim($trios[$i * 3 + 2][4]);
                $newTrio->explanation1 = $newTrio->explanation2 = $newTrio->explanation3 = $this->currentAnswer;
                $newTrio->answer = trim(strtolower($this->answers[$this->currentAnswer]));
                $newTrio->save();

                $this->currentAnswer++;
            }
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
