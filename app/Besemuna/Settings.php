<?php
namespace Besemuna;
use App\Conversations\SettingsConversation;
use App\User;
use \Carbon\Carbon;

class Settings {
/* @var username */
public $username;

/* @var password */
public $password;

public function __construct() {

}

/**
 * Starts the conversation to get info from user to update settings
 */
public function startConversation($bot) {
    $bot->startConversation(new SettingsConversation($bot));
    
}

/** Updates the user's info
 * @param array $info
 */
public static function updateUser( array $info) {
    $bot = $info['bot'];
    $user = $bot->getUser();

    // check if user already exists
    try {
        $u = User::where("telegram_userid", $user->getID())->firstOrFail();
        $u->userid = $info["userID"];
        $u->password = $info["password"];
        $u->telegram_userid = $user->getID();
        $u->telegram_username = $user->getUsername();
        $u->telegram_firstname = $user->getfirstName();
        $u->telegram_lastname = $user->GetLastName();
        $u->telegram_lastinfoupdate = Carbon::now();
        $u->save();
        $bot->reply('UPDATED');

    } catch( \Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // create new user
        $u = new User();
        $u->userid = $info["userID"];
        $u->password = $info["password"];
        $u->telegram_userid = $user->getID();
        $u->telegram_username = $user->getUsername();
        $u->telegram_firstname = $user->getfirstName();
        $u->telegram_lastname = $user->GetLastName();
        $u->telegram_lastinfoupdate = Carbon::now();
        $u->save();

        $bot->reply('ACCOUNT CREATED');
    };

    
}

}

?>