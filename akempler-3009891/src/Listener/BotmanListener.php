<?php

namespace Drupal\botman\Listener;

use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

require __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Provides a service for instantiating the Botman instance.
 *
 * @package Drupal\botman\Listener
 *
 * @TODO Probably should not be a service as developers need to be able to
 *  specify settings such as config, cache, driver, etc.
 */
class BotmanListener implements ListenerInterface {

  public function initialize() {
    $adapter = new FilesystemAdapter();
    $config = [];
    DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
    $botman = BotManFactory::create($config, new SymfonyCache($adapter));

    return $botman;
  }
}