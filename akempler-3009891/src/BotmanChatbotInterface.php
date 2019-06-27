<?php

namespace Drupal\botman;

use Drupal\Component\Plugin\PluginInspectionInterface;
use BotMan\BotMan\BotMan;

/**
 * Base interface definition for BotmanChatbot plugins.
 *
 * @see \Drupal\botman\Annotation\BotmanChatbot
 * @see \Drupal\botman\BotmanChatbotInterface
 * @see \Drupal\botman\BotmanChatbotManager
 * @see plugin_api
 */
interface BotmanChatbotInterface extends PluginInspectionInterface {

  /**
   * Create the Botman instance.
   */
  public function initialize();

}