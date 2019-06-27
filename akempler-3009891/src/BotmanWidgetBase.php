<?php

namespace Drupal\botman;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
#use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Base class for Botman widget plugins.
 */
abstract class BotmanWidgetBase extends PluginBase implements BotmanWidgetInterface {

  /**
   * The configuration array passed from the BotmanChatBlock.
   *
   * @var array
   */
  protected $configuration;

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  abstract public function build();

  /**
   * {@inheritdoc}
   */
  public function widgetSettings() {
    $form = [];
    $form['#attached']['library'][] = 'botman/botman.colorpicker';
    return $form;
  }

}
