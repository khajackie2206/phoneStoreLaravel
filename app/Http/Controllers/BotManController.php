<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;


class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}',function($botman,$message){

            if ($message == 'hi') {
                $this->askName($botman);
            }else{
                $botman->reply("http://www.google.com");
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