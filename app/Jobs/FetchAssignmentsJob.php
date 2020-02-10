<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchAssignmentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;

    public function __construct($user)
    {
      $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
      #login in
      $login = new \Besemuna\Login($this->user->userid, $this->user->password);
      $session = $login->logUserIn();

      # get all sites and get assignments for these sites
      $sites = \App\Site::all();

      foreach ($sites as $site) {
        echo "Getting resources for each site \n";

        $assignmentsObject = new \Besemuna\Assignment($session);
        $assignments = $assignmentsObject->fetchAssignments($site->site_id);    

        # persists assignments
        $assignmentsObject->persistAssignments($this->user, $assignments, $site->site_id);
      }

      
    }
}
