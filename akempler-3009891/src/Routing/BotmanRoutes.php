<?php

namespace Drupal\botman\Routing;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\StreamWrapper\StreamWrapperManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Route;

/**
 * Defines a route subscriber to register urls for serving chatbots.
 */
class BotmanRoutes implements ContainerInjectionInterface {

  /**
   * The stream wrapper manager service.
   *
   * @var \Drupal\Core\StreamWrapper\StreamWrapperManagerInterface
   */
  protected $streamWrapperManager;

  /**
   * Constructs a new chatbot route subscriber.
   *
   * @param \Drupal\Core\StreamWrapper\StreamWrapperManagerInterface $stream_wrapper_manager
   *   The stream wrapper manager service.
   */
  public function __construct(StreamWrapperManagerInterface $stream_wrapper_manager) {
    $this->streamWrapperManager = $stream_wrapper_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('stream_wrapper_manager')
    );
  }

  /**
   * Add a route for each chatbot plugin.
   *
   * @return \Symfony\Component\Routing\Route[]
   *   An array of route objects.
   *
   * @TODO allow config setting rather than hadcoded 'botman/' base path.
   */
  public function routes() {
    $routes = [];

    $widget_plugin_definitions = \Drupal::service('plugin.manager.botman.chatbot')
      ->getDefinitions();
    foreach ($widget_plugin_definitions as $plugin_id => $plugin_definition) {
      $routes["botman.botman_$plugin_id"] = new Route(
        'botman/' . $plugin_id,
        [
          '_controller' => 'Drupal\botman\Controller\BotmanController::listener',
          '_title' => 'Listener',
          'plugin' => $plugin_id,
        ],
        [
          '_permission' => 'access content',
        ]
      );
    }

    return $routes;
  }

}
