<?php

namespace Drupal\botman;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Class BotmanChatbotManager
 *
 * @package Drupal\botman
 */
class BotmanChatbotManager extends DefaultPluginManager {

  /**
   * Constructs a new BotmanChatbotManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.ß
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/BotmanChatbot', $namespaces, $module_handler, 'Drupal\botman\BotmanChatbotInterface', 'Drupal\botman\Annotation\BotmanChatbot');

    $this->alterInfo('botman_chatbot_info');
    $this->setCacheBackend($cache_backend, 'botman_chatbot_plugins');
  }
}

