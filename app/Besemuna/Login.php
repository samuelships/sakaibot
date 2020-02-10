<?php
namespace Besemuna;

class Login {
    use General;

    public $username = "10853051";
    public $password = "64307";


    public function __construct ($userID, $password) {
        $this->userID = $userID;
        $this->password = $password;
    }

    /**
     * Tries to login the user into the sakai website
     * @return string $session Session of the logged in user
     */
    public function LogUserIn() {
        echo("Logging in ");

        $headers = array('Accept' => 'application/json');
        $query = array('eid' => $this->userID, 'pw' => $this->password, "submit" => "Login");
        $response = \Unirest\Request::post(self::$baseUrl . "portal/relogin", $headers, $query);

        $sessionOne = $response->headers["Set-Cookie"][0];
      
        \Unirest\Request::cookie($sessionOne);

        echo("Logged In ");
        echo $sessionOne;
        return $sessionOne;
    
    }
    // MUST DO 
    // 1. Write an exception class to check wrong credentials
}