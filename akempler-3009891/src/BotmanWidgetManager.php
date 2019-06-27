<?php

namespace Drupal\botman;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Class BotmanWidgetManager
 *
 * @package Drupal\botman
 */
class BotmanWidgetManager extends DefaultPluginManager {

  /**
   * Constructs a new BotmanWidgetManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/BotmanWidget', $namespaces, $module_handler, 'Drupal\botman\BotmanWidgetInterface', 'Drupal\botman\Annotation\BotmanWidget');

    $this->alterInfo('botman_widget_info');
    $this->setCacheBackend($cache_backend, 'botman_widget_plugins');
  }
}

