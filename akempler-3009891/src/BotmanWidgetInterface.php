<?php

namespace Drupal\botman;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines a common interface for all botman widgets.
 *
 * @package Drupal\botman
 */
interface BotmanWidgetInterface extends PluginInspectionInterface {

  /**
   * Return a render array.
   *
   * @return array
   *  A Drupal render array.
   */
  public function build();

  /**
   * Return optional widget specific configuration settings.
   *
   * These will be displayed in the chatbot block form.
   *
   * @param array
   *  An array of previously saved/default settings. Empty array if none exist.
   *
   * @return mixed
   */
  public function widgetSettings();

}