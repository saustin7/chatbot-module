<?php

namespace Drupal\botman\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\botman\Listener\BotmanListener;

use BotMan\BotMan\BotMan;

/**
 * Controller for chatbot callbacks.
 *
 * Instantiates the chatbot and widgdet plugins.
 *
 * @package Drupal\botman\Controller
 */
class BotmanController extends ControllerBase {

  /**
   * @var \BotMan\BotMan\BotMan
   */
  protected $botman;


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $ListenerService = $container->get('botman.listener');
    return new static($ListenerService);
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(BotmanListener $ListenerService) {
    $this->botman = $ListenerService->initialize();
  }

  /**
   * Instantiate the BotmanChatbot plugin and pass it a Botman instance.
   *
   * This is triggered by the dynamic routes of /botman/{plugin}
   *
   * @param string $plugin
   *  The id of the plugin.
   *
   * @return \Symfony\Component\HttpFoundation\Response
  */
  public function listener($plugin) {

    if ($plugin) {
      $chatbot_plugin_manager = \Drupal::service('plugin.manager.botman.chatbot');
      $chatbot_plugin_manager
        ->createInstance($plugin)
        ->listener();
      return new Response();

    } else {
      // TODO handle error in response.
      return new Response();
    }

  }
}
