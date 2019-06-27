<?php

namespace Drupal\botman\Listener;

//use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base interface for the BotmanListener class.
 *
 * @package Drupal\botman\Listener
 */
interface ListenerInterface {

  public function initialize();
}