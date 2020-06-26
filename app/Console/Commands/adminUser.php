<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class adminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

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
        $data = [
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=> bcrypt('12345678'),
        ];

        User::create( $data);
        $this->info('Admin has been created! email: admin@gmail.com  password: 12345678');
    }
}
