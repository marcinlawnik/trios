<?php

use Illuminate\Database\Seeder;
use App\Trio;

class TriosDevTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_US');
        for($i=0;$i<100;$i++){
            //Below a rand or mt_rand function can be used
            $sentenceLength = $faker->numberBetween(4,7);
            $explanationLength = $faker->numberBetween(2,5);
            Trio::create([
                'sentence1' => $faker->sentence($sentenceLength),
                'sentence2' => $faker->sentence($sentenceLength),
                'sentence3' => $faker->sentence($sentenceLength),
                'explanation1' => implode(' ', $faker->sentences($explanationLength)),
                'explanation2' => implode(' ', $faker->sentences($explanationLength)),
                'explanation3' => implode(' ', $faker->sentences($explanationLength)),
                'answer' => $faker->word
            ]);
        }
    }
}
