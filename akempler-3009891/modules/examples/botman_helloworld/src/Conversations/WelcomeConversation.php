<?php

namespace Drupal\botman_helloworld\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class WelcomeConversation extends Conversation {

  protected $firstname;

  public function askFirstname() {
    $this->ask('What is your first name?', function(Answer $answer) {
      $this->firstname = $answer->getText();

      $this->greeting();
    });
  }

  public function greeting() {
    $this->say('Nice to meet you ' . $this->firstname);
  }

  public function run() {
    $this->askFirstname();
  }
}
