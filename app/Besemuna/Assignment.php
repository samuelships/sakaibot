<?php
namespace Besemuna;

class Assignment {
    use General;

    public $siteID;
    public $payload;
    public $session;


    public function __construct($session) {
        $this->session = $session;
    }
    /**
     * This function periodically fetches assignments from sakai
     * @param string $siteID ID of the site you want to fetch assignments from
     * @return string $payload JSON payload of the assigments
     */
    public function fetchAssignments ($siteID) {
        $this->siteID = $siteID;

        echo "fetching assignments";

        \Unirest\Request::cookie($this->session);
        $response = \Unirest\Request::get(self::$baseUrl . "direct/assignment/site/" . $this->siteID . ".json");
        $this->payload = $response->raw_body;
        return $this->payload;
        
    }

     /**
     * Persists assignments  in db
     * @param string $payload Json payload of sites
     * @param \App\User $user object 
     * @param string $siteID siteID 
     * @return bool $status 1 if success 0 if false
     */
    public function persistAssignments ( \App\User $user,string $payload, string $siteID) {
        $this->payload = $payload;
        echo "persisting assignments";
        $json = json_decode($this->payload, TRUE);
        // print_r($json["assignment_collection"][0]);
       

        # persist payload
        try {
            $assignmentFetch = \App\AssignmentFetch::create([
                "site_id" => $siteID,
                "user_id" => $user->id,
                "payload" => $this->payload,
                "time_queried" => date("Y-m-d H:i:s")
            ]);
        } catch(Exception $e) {

            // handle exceptions later
        }
      
        # persist individual sites if they don't exists
        foreach ($json["assignment_collection"] as $assignment) {
            
            try {
                \App\Assignment::firstorCreate([
                    "assignment_id" => $assignment["entityId"]
                ],[
                    "user_id" => $user->id,
                    "assignment_fetch_id" => $assignmentFetch->id,
                    "payload" => json_encode($assignment)
                ]);
            }catch (Exception $e) {
                // Handle exceptions
            }
        }
    }
}                                                                                                                                   