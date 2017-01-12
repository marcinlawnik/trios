<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use App\Trio;

class ExportJson extends Command
{
    protected $error = [];
    protected $outputArray = [
        'trios' => []
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export trios to JSON files';

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

        foreach ($trios as $trio) {
            $this->addTrio($trio);
        }

        $this->saveFile();

    }

    private function addTrio(Trio $trio) {
        $this->outputArray['trios'][] = [
            'sentence1' => $trio->sentence1,
            'sentence2' => $trio->sentence2,
            'sentence3' => $trio->sentence3,
            'explanation1' => $trio->explanation1,
            'explanation2' => $trio->explanation2,
            'explanation3' => $trio->explanation3,
            'answer' => $trio->answer
        ];
    }

    private function saveFile() {

        $filename = 'triosExport'.date('_Y_m_d_H_i_s').'.json';
        Storage::put('trios/' . $filename, json_encode($this->outputArray, JSON_PRETTY_PRINT));
    }
}
