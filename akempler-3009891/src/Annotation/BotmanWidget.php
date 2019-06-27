<?php

namespace Drupal\botman\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Botman Widget.
 *
 * Botman Widgets define an interface/ui for chatbots.
 *
 * @see \Drupal\botman\BotmanWidgetBase
 *
 * @ingroup botman
 *
 * @Annotation
 */
class BotmanWidget extends Plugin {

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
