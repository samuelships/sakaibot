<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use \Besemuna\Settings;

class SettingsConversation extends Conversation
{
    /** @var botinstance */
    public $bot;

    /** @var userID */
    public $userID;

    /** @var password */
    public $password;


    public function __construct($bot) {
        $this->bot = $bot;
    }

    /**
     * Start Conversation
     */
    public function start () {
     
        $question = Question::create("What would you like to change")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('UserID and password')->value('1'),
                Button::create('Others')->value('2'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === '1') {
                    $this->askUserID();
                } else {
                    $this->say('Other settings not availbale for now');
                }
            }
        });
    }

    /**
     * Ask UserID
     */
    public function askUserID () {
        $question = Question::create("What is your next userID")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason');
            

        return $this->ask($question, function (Answer $answer) {
            // $this->say('Your userID is :' . $answer);
            $this->userID = $answer;
            $this->askPassword();
        });
    }

    /**
     * Ask Password
     */
    public function askPassword () {
        $question = Question::create("What is your next password")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason');
            

        return $this->ask($question, function (Answer $answer) {
            // $this->say('Your password is : ' . $answer);
            $this->password = $answer;

            // update user
            Settings::updateUser([
                "bot" => $this->bot,
                "userID" => $this->userID,
                "password" => $this->password
            ]);
        });

        // update values
        
        
    }


    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->start();
    }
}
