<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->app->environment() !== 'production') {
            $this->call(TriosDevTableSeeder::class);
        }
        $this->call(EntrustSeeder::class);
    }
}
