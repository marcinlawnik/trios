<?php

namespace App\Console\Commands;

use App\Trio;
use Illuminate\Console\Command;

class CheckTrios extends Command
{
    private $failCounter;
    private $error;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:trios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check trios validity.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->error = false;

    }

    private function lastCharacter ($string) {
        return substr($string, -1);
    }

    private function processPunctuationError(Trio $trio, $sentenceNumber) {
        $this->info("Punctuation error: db_id {$trio->id}: sentence{$sentenceNumber} (book_id: $trio->explanation1)");
        $sentenceSequence = 'sentence' . $sentenceNumber;
        $this->info('Last character:' . $this->lastCharacter($trio->{$sentenceSequence}));
        //Apply fix for $ sign
        if($this->lastCharacter($trio->{$sentenceSequence}) == '$') {
            $trio->$sentenceSequence .= '.';
            $trio->save();
        }
        $this->error = true;
        $this->failCounter++;
    }

    private function processMarkerError(Trio $trio, $sentenceNumber) {
        $this->info("Marker error: db_id {$trio->id}: sentence{$sentenceNumber} (book_id: $trio->explanation1)");
        $this->error = true;
        $this->failCounter++;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $trios = Trio::all();

        $punctuation = [
            '.', '!', '?'
        ];

        foreach($trios as $trio) {
            //Check for $@$ marker.
            if(strpos($trio->sentence1, '$@$') === false) {
                $this->processMarkerError($trio, 1);
            }
            if(strpos($trio->sentence2, '$@$') === false) {
                $this->processMarkerError($trio, 2);
            }
            if(strpos($trio->sentence3, '$@$') === false) {
                $this->processMarkerError($trio, 3);
            }

            //Check for punctuation at the end of the sentence.
            if(!in_array($this->lastCharacter($trio->sentence1), $punctuation)) {
                $this->processPunctuationError($trio, 1);
            }
            if(!in_array($this->lastCharacter($trio->sentence2), $punctuation)) {
                $this->processPunctuationError($trio, 2);
            }
            if(!in_array($this->lastCharacter($trio->sentence3), $punctuation)) {
                $this->processPunctuationError($trio, 3);
            }
        }

        if(!$this->error) {
            $this->info('All trios passed the checks.');
        } else {
            $this->error("Some {$this->failCounter} sentences failed the checks.");
        }
    }
}
