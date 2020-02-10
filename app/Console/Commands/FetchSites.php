<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Jobs\FetchSitesJob;

class FetchSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sakaibot:fetch:sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches all sites of a user and persists in db';

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
            FetchSitesJob::dispatch($user);
        }

    }
}
