<?php
use App\Http\Controllers\BotManController;
use Besemuna\Settings;
use Besemuna\About;
use App\Conversations\SettingsConversation;

$botman = resolve('botman');


// ABOUT COMMAND
$botman->hears('/about', function ($bot) {
    About::display($bot);
});


// SETTINGS COMMAND
$botman->hears('/settings', function ($bot) {
    $settings = new Settings();
    $settings->startConversation($bot);

    // $bot->sendRequest('sendMessage', [
    //     "text" => 'Which settings do you want to change?',
    //     "reply_markup" => '{
    //         "inline_keyboard": [[
    //             {
    //                 "text": "A",
    //                 "callback_data": "A"            
    //             }, 
    //             {
    //                 "text": "B",
    //                 "callback_data": "C1"            
    //             }]
    //         ]
    //     }'
    // ]);
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');