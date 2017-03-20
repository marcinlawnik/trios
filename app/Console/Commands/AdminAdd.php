<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add an admin to the application';

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
        $userId = $this->ask('Enter the ID of user to be made admin:');
        $user = \App\User::find($userId); # zamiast jedynki ID użytkownika
        if ($this->confirm('Do you really want to make user ' . $user->name . ' admin?')) {
            $admin = \App\Role::whereName('admin')->first(); # admin - może wszystko
            if ($admin === null) {
                $this->error('Admin role not found. Try running php artisan db:seed --class EntrustSeeder');
            } else {
                # jeśli rola jest niedostępna, trzeba najpierw uruchomić php artisan db:seed --class EntrustSeeder
                $user->attachRole($admin);
                $user->save();
                $this->info('Admin added.');
            }
;       } else {
            $this->error('Aborted.');
        }

    }
}
