<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Besemuna\Assignment;
use Besemuna\Login;
use Besemuna\Site;
use \App\Jobs\FetchAssignmentsJob;

class FetchAssignments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sakaibot:fetch:assignments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches Assignments for all sites';

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
       # get all users and credentials
       $users = \App\User::all();

       # push job to queue
       foreach ($users as $user) {
           FetchAssignmentsJob::dispatch($user);
       } 


    }
}
