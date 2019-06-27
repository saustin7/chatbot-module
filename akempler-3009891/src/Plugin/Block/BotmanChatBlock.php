<?php

namespace Drupal\botman\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a BotmanChatBlock block.
 *
 * @Block(
 *   id = "botman_chat_block",
 *   admin_label = @Translation("Botman Chat block"),
 * )
 */
class BotmanChatBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'botman_chat_text' => $this->t('Chat'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->getConfiguration();

    $widget_manager = \Drupal::service('plugin.manager.botman.widget');
    $build = $widget_manager
      ->createInstance($config['botman_widget'], $config)
      ->build();

    $build['#attached']['drupalSettings']['botman']['botman_route'] = $config['botman_chatbot'];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $widget_manager = \Drupal::service('plugin.manager.botman.widget');
    $widget_plugin_definitions = $widget_manager->getDefinitions();
    $widgets = [];
    foreach ($widget_plugin_definitions as $plugin_id => $plugin_definition) {
      $widgets[$plugin_id] = $plugin_definition['label']->render();
    }

    $form['botman_widget'] = [
      '#type' => 'select',
      '#title' => t('Widget'),
      '#options' => $widgets,
      '#default_value' => isset($config['botman_widget']) ? $config['botman_widget'] : 0,
    ];

    foreach ($widgets as $key => $value) {
      $form['widget_settings'][$key] = [
        '#type' => 'container',
        '#attributes' => [
          '#class' => 'widget_settings',
        ],
        '#states' => [
          'visible' => [
            'select[name="settings[botman_widget]"]' => ['value' => $key],
          ]
        ]
      ];

      $form['widget_settings'][$key] += $widget_manager
        ->createInstance($key, $config)
        ->widgetSettings();
    }

    // Display the available chatbots for selection.
    $chatbot_plugin_definitions = \Drupal::service('plugin.manager.botman.chatbot')
      ->getDefinitions();
    $chatbots = [];

    foreach ($chatbot_plugin_definitions as $plugin_id => $plugin_definition) {
      $chatbots[$plugin_id] = $plugin_definition['label']->render();
    }
    $form['botman_chatbot'] = [
      '#type' => 'select',
      '#title' => t('Chatbot'),
      '#options' => $chatbots,
      '#default_value' => isset($config['botman_chatbot']) ? $config['botman_chatbot'] : 0,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['botman_widget'] = $form_state->getValue('botman_widget');
    $this->configuration['botman_chatbot'] = $form_state->getValue('botman_chatbot');

    // Save the values from the widget forms.
    $values = $form_state->getValues();
    foreach ($values['widget_settings'] as $plugin_id => $settings) {
      $this->configuration['widget_settings'][$plugin_id] = $settings;
    }
  }

}
