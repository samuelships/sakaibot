<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchSitesJob implements ShouldQueue
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
        # login in
        $login = new \Besemuna\Login($this->user->userid, $this->user->password);
        $session = $login->logUserIn();

        # fetch fetch
        $sitesObject = new \Besemuna\Site($session);
        $sites = $sitesObject->fetchSites($this->user);
        
        # persists sites
        $sitesObject->persistSites($this->user, $sites);
    }
}
