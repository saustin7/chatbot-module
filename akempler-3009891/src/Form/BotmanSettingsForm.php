<?php
/**
 * @file
 * Contains \Drupal\botman\Form\BotmanSettingsForm.
 */

namespace Drupal\botman\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configures the chatbot interface.
 */
class BotmanSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'botman.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'botman_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('botman.settings');

    $form['chatbot_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Chatbot Name'),
      '#description' => $this->t('The name to display at the top of the chatbot window.'),
      '#default_value' => $config->get('chatbot_name'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('botman.settings');
    $config->set('chatbot_name', $form_state->getValue('chatbot_name'));
    $config->save();

    return parent::submitForm($form, $form_state);
  }


}
