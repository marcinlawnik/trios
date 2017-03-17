<?php

namespace App\Console\Commands;

use App\Trio;
use Illuminate\Console\Command;

class CheckTrios extends Command
{
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
     * @return mixed
     */
    public function handle()
    {
        $trios = Trio::all();
        foreach($trios as $trio) {
            $id = $trio->id;
            if(strpos($trio->sentence1, '$@$') === false) {
                $this->info("db_id $id: sentence1 (book_id: ${trio['explanation1']})");
            }
            if(strpos($trio->sentence2, '$@$') === false) {
                $this->info("db_id $id: sentence2 (book_id: ${trio['explanation1']})");;
            }
            if(strpos($trio->sentence3, '$@$') === false) {
                $this->info("db_id $id: sentence3 (book_id: ${trio['explanation1']})");;
            }
        }
    }
}
