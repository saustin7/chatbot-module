<?php

namespace Drupal\botman\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\HtmlResponse;

/**
 * Controller for webwidget.
 *
 * Renders the content in the iframe.
 *
 * @package Drupal\botman\Controller
 */
class WebWidgetController extends ControllerBase {

  /**
   * Route callback for /botman/widget
   *
   * @return \Drupal\Core\Render\HtmlResponse
   */
  public function widget() {
    // This is the html that gets rendered in the iframe -
    // the chatbot ui/interface.
    $render_element['chatbot'] = [
      '#theme' => 'web_widget',
      '#name' => 'Chatbot',
      '#css_path' => drupal_get_path('module', 'botman') . '/css/web_widget.css',
    ];

    $html = \Drupal::service('renderer')->renderRoot($render_element);
    $HtmlResponse = new HtmlResponse([
      '#markup' => $html,
    ]);

    return $HtmlResponse;
  }

}
