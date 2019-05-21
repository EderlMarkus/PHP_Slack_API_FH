<?php
require 'slack.php';

class Jarvis
{

    const CHANNEL = "";
    const TEST = "";



    public function __construct($testchannel, $channel)
    {
        $this->CHANNEL = $channel;
        $this->TEST = $testchannel;
    }

    public function writeSlackMessage($text, $test)
    {
        if ($test) {
            $SlackHookAdress = $this->TEST;
        } else {
            $SlackHookAdress = $this->CHANNEL;
        }
        $slack = new Slack($SlackHookAdress);
        $message = new SlackMessage($slack);
        $message->setText($text);
        return $message->send();
    }

}
