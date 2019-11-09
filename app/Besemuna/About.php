<?php
namespace Besemuna;

class About {
    public static $aboutText = "
    <b>ABOUT THIS BOT </b>

    This is a <b>SAKAI</b> bot which interfaces with the SAKAI 
    website on your behalf for a smooth student experience 📚. 
    This bot can do the following actions.

	    1. Alert you when new assignments 📑
	    2. Download and send assignments to you 💾
	    3. Alert you when new announcements arrive 📢
	    4. Download your gradebook 📝
	    5. Download resources 📚
	    6. Download syllabus 📌
	    7. And a lot more 👅

    Made With ❤️ By <b>@viralsamuel</b>";

    public static function display($bot) {

        $bot->sendRequest('sendMessage', [
            'text' => self::$aboutText,
            'parse_mode' => 'html'
        ]);
    }

}