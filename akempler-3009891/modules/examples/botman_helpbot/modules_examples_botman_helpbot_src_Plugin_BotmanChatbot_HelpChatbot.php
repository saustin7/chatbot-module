<?php
/**
 * Example implementation of the BotmanChatbot Plugin.
 */

namespace Drupal\botman_helpbot\Plugin\BotmanChatbot;

use Drupal\botman\BotmanChatbotBase;
use Drupal\botman\BotmanChatbotInterface;

// Include our Conversation.
//use Drupal\botman_helloworld\Conversations\WelcomeConversation;

/**
 * @BotmanChatbot(
 *  id = "helpchatbot",
 *  label = @Translation("Help Chatbot")
 * )
 */
class HelpChatbot extends BotmanChatbotBase implements BotmanChatbotInterface {

  /**
   * {@inheritdoc}
   */
  public function initialize() {

    $this->botman->hears('hello|hi|hola', function () {
      $this->botman->reply('Hello, nice to meet you.');
    });

    $this->botman->hears('bye|goodbye', function () {
      $this->botman->reply('See you later alligator.');
    });

    //$this->botman->hears('help', function () {
    //  $this->botman->startConversation(new WelcomeConversation());
    //});

    $this->botman->fallback(function() {
      $this->botman->reply('Sorry, I did not understand your request.' . PHP_EOL . 'Type help at any time.');
    });

  }

}
