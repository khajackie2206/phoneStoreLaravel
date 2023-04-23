<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Attachments\Video;


class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}',function($botman,$message){

$attachment = new Image('https://i.imgur.com/9YQ9Z0M.jpg');

            $send = OutgoingMessage::create('This is my text')
                ->withAttachment($attachment);

            if ($message == 'hi') {

                $this->askName($botman);
            }else{
            }

        });

        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask("Hello! What is Your Name?",function(Answer $answer){
            $name = $answer->getText();

            $this->say('Nice to meet you '.$name);
        });
    }

     public function askLogic($botman)
    {
        $botman->ask("Hoài mõm là ai?",function(Answer $answer){
            // $name = $answer->getText();

            $this->say('Hoài mõm là Tô Lê Hoài');
        });
    }

}
