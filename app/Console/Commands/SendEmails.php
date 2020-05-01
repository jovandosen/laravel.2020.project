<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foo:example {name=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test foo example artisan command.';

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
        $this->info('Please enter your name.');
        $name = $this->ask('What is your name?');
        echo 'Hello ' . $name;

        $this->line('User List:');
        $headers = ['ID', 'Name', 'Email'];
        $users = User::all(['id', 'name', 'email'])->toArray();
        $this->table($headers, $users);
    }
}
