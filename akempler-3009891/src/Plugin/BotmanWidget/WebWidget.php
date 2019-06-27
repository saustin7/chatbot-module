<?php

namespace Drupal\botman\Plugin\BotmanWidget;

use Drupal\botman\BotmanWidgetBase;

/**
 * @BotmanWidget(
 *  id = "web_widget",
 *  label = @Translation("WebWidget"),
 *  libraries = {
 *   "botman/botman.web_widget"
 *  }
 * )
 */
class WebWidget extends BotmanWidgetBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = [
      'botman_chat_block' => [
        '#attached' => ['library' =>
          ['botman/botman.web_widget']
        ],
      ],
    ];

    $build['#attached']['drupalSettings']['botman']['intro_message'] = $this->configuration['widget_settings']['web_widget']['intro_message'];
    $build['#attached']['drupalSettings']['botman']['header_bg_color'] = $this->configuration['widget_settings']['web_widget']['header_bg_color'];
    $build['#attached']['drupalSettings']['botman']['header_text_color'] = $this->configuration['widget_settings']['web_widget']['header_text_color'];
    $build['#attached']['drupalSettings']['botman']['widget_launcher_bg_color'] = $this->configuration['widget_settings']['web_widget']['widget_launcher_bg_color'];
    $build['#attached']['drupalSettings']['botman']['header_title'] = $this->configuration['widget_settings']['web_widget']['header_title'];
    $build['#attached']['drupalSettings']['botman']['about_text'] = $this->configuration['widget_settings']['web_widget']['about_text'];
    $build['#attached']['drupalSettings']['botman']['about_link'] = $this->configuration['widget_settings']['web_widget']['about_link'];
    /*$build['#attached']['drupalSettings']['botman']['botman_route'] = $this->configuration['widget_settings']['web_widget']['botman_route'];*/

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function widgetSettings() {

    $form = parent::widgetSettings();

    $default_config = \Drupal::config('botman.settings');

    $form['header_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header Title.'),
      '#description' => $this->t('Optional text to display in the widget header.'),
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['header_title']) ? $this->configuration['widget_settings']['web_widget']['header_title'] : $default_config->get('widget_settings.web_widget.header_title'),
    ];

    $form['intro_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Intro Text'),
      '#description' => $this->t('This will be displayed at the top of the chat window.'),
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['intro_message']) ? $this->configuration['widget_settings']['web_widget']['intro_message'] : $default_config->get('widget_settings.web_widget.intro_message'),
    ];

    $form['widget_launcher_bg_color'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Widget Launcher Background Color'),
      '#description' => $this->t('A hex color value for the widget launcher background color.'),
      '#size' => 8,
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['widget_launcher_bg_color']) ? $this->configuration['widget_settings']['web_widget']['widget_launcher_bg_color'] : $default_config->get('widget_settings.web_widget.widget_launcher_bg_color'),
      '#attributes' => [
        'class' => ['jscolor'],
      ],
    ];

    $form['header_bg_color'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header Background Color'),
      '#description' => $this->t('A hex color value for the header bar background color.'),
      '#size' => 8,
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['header_bg_color']) ? $this->configuration['widget_settings']['web_widget']['header_bg_color'] : $default_config->get('widget_settings.web_widget.header_bg_color'),
      '#attributes' => [
        'class' => ['jscolor'],
      ],
    ];

    $form['header_text_color'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header Text Color'),
      '#description' => $this->t('A hex color value for the header bar text.'),
      '#size' => 8,
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['header_text_color']) ? $this->configuration['widget_settings']['web_widget']['header_text_color'] : $default_config->get('widget_settings.web_widget.header_text_color'),
      '#attributes' => [
        'class' => ['jscolor'],
      ],
    ];

    $form['about_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('About Text.'),
      '#description' => $this->t('Optional text to display in the widget footer.'),
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['about_text']) ? $this->configuration['widget_settings']['web_widget']['about_text'] : '',
    ];

    $form['about_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('About Link.'),
      '#description' => $this->t('Optional link used when About Text is clicked.'),
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['about_link']) ? $this->configuration['widget_settings']['web_widget']['about_link'] : '',
    ];


    // TODO not used anywhere yet. Also needs to be saved permanently. Submit hadndler not getting triggered.
    $form['widget_icon'] = [
      '#title' => $this->t('Widget Icon'),
      '#type' => 'managed_file',
      '#description' => $this->t('Floating widget icon.'),
      '#upload_location' => 'public://botman/',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
      '#default_value' => isset($this->configuration['widget_settings']['web_widget']['widget_icon']) ? $this->configuration['widget_settings']['web_widget']['widget_icon'] : '',
      '#submit' => [[get_class($this), 'web_widget_submit']]
    ];

    return $form;
  }


  function web_widget_submit(array $form, FormStateInterface $form_state){
    // TODO implement file saving - permanent.
  }

}
