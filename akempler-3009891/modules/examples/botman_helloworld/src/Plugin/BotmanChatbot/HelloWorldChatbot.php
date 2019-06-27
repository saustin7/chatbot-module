<?php
namespace Drupal\botman_helloworld\Plugin\BotmanChatbot;

use Drupal\botman\BotmanChatbotBase;
use Drupal\botman\BotmanChatbotInterface;

use BotMan\BotMan\BotMan;

/**
 * @BotmanChatbot(
 *  id = "helloworldtest",
 *  label = @Translation("HelloWorldTest")
 * )
 */
class HelloWorldChatbot extends BotmanChatbotBase implements BotmanChatbotInterface {

  /**
   * {@inheritdoc}
   */
  public function initialize(Botman $botman) {
    $botman->hears('hello|hi|hola', function (Botman $botman) {
      $botman->reply('Hello, nice to meet you.');
    });

    return $botman;
  }
}
