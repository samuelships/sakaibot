<?php
namespace Besemuna;

class Site {
    use General;

    public $siteID;
    public $siteName;
    public $payload;
    public $session;

    public function __construct($session) {
        $this->session = $session;
    }

    /**
     * Fetches Sites for a user 
     * @param \App\User user
     * @return string $payload Payload of the data fetched
     */
    public function fetchSites (\App\User $user) {
        echo "fetching sites";
        \Unirest\Request::cookie($this->session);
        $response = \Unirest\Request::get(self::$baseUrl . "direct/site.json");
        echo "fetched sites";
        return $response->raw_body;
    }

    /**
     * Persists sites in db
     * @param string $payload Json payload of sites
     * @param \App\User $user object 
     * @return bool $status 1 if success 0 if false
     */
    public function persistSites ( \App\User $user,string $payload) {
        $this->payload = $payload;
        echo "persisting sites";
        $json = json_decode($this->payload, TRUE);
        // print_r($json["site_collection"][0]);

        # persist payload
        try {
            $siteFetch = \App\SiteFetch::create([
                "user_id" => $user->id,
                "payload" => $this->payload,
                "time_queried" => date("Y-m-d H:i:s")
            ]);
        } catch(Exception $e) {

            // handle exceptions later
        }

        # persist individual sites if they don't exists
        foreach ($json["site_collection"] as $site) {
            
            try {
                \App\Site::firstorCreate([
                    "site_id" => $site["sitePages"][0]["siteId"]
                ],[
                    "site_fetch_id" => $siteFetch->id,
                    "user_id" => $user->id,
                    "name" => $site["entityTitle"]
                ]);
            }catch (Exception $e) {
                // Handle exceptions
            }
        }
    }
}                                                                                                                                   