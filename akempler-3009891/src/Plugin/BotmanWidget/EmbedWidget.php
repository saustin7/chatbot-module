<?php

namespace Drupal\botman\Plugin\BotmanWidget;

use Drupal\botman\BotmanWidgetBase;


/**
 * @BotmanWidget(
 *  id = "embed_widget",
 *  label = @Translation("EmbedWidget"),
 *  libraries = {
 *   "botman/botman.embed_widget"
 *  }
 * )
 */
class EmbedWidget extends BotmanWidgetBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = [
      'botman_chat_block' => [
        '#theme' => 'embed_widget',
        '#header_title' => $this->configuration['widget_settings']['embed_widget']['header_title'],
        '#attached' => ['library' =>
          ['botman/botman.axios', 'botman/botman.vuejs', 'botman/botman.embed_widget', 'botman/botman.font_awesome']
        ],
      ],
    ];

    $build['#attached']['drupalSettings']['botman']['embed_widget']['chatbot_name'] = $this->configuration['widget_settings']['embed_widget']['chatbot_name'];

    return $build;
  }

  public function widgetSettings(array $settings=[]) {

    $form = parent::widgetSettings();

    $default_config = \Drupal::config('botman.settings');

    $form['header_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header Title'),
      '#description' => $this->t('Optional text to display in the widget header.'),
      '#default_value' => isset($this->configuration['widget_settings']['embed_widget']['header_title']) ? $this->configuration['widget_settings']['embed_widget']['header_title'] : $default_config->get('widget_settings.embed_widget.header_title'),
    ];

    $form['chatbot_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Chatbot Name'),
      '#description' => $this->t('This will be displayed with each chatbot message.'),
      '#default_value' => isset($this->configuration['widget_settings']['embed_widget']['chatbot_name']) ? $this->configuration['widget_settings']['embed_widget']['chatbot_name'] : $default_config->get('widget_settings.embed_widget.chatbot_name'),
    ];

    $form['embed_collapsed'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Collapsed by default'),
      '#description' => $this->t('If checked the interface will be collapsed by default.'),
      '#default_value' => isset($this->configuration['widget_settings']['embed_widget']['embed_collapsed']) ? $this->configuration['widget_settings']['embed_widget']['embed_collapsed'] : $default_config->get('widget_settings.embed_widget.embed_collapsed'),
    );

    return $form;
  }


}
