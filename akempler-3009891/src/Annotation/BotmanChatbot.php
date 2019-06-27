<?php

namespace Drupal\botman\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Botman Chatbot.
 *
 * @see \Drupal\botman\BotmanChatbotManager
 * @see plugin_api
 *
 * @Annotation
 */
class BotmanChatbot extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
