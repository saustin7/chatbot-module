<?php

namespace Drupal\botman;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\botman\Listener\BotmanListener;
use Symfony\Component\HttpFoundation\Response;
use BotMan\BotMan\BotMan;

/**
 * Base class for Botman chatbot plugins.
 *
 * @see \Drupal\botman\Annotation\BotmanChatbot
 * @see \Drupal\botman\BotmanChatbotInterface
 * @see \Drupal\botman\BotmanChatbotManager
 * @see plugin_api
 */
abstract class BotmanChatbotBase extends PluginBase implements BotmanChatbotInterface, ContainerFactoryPluginInterface {

  /**
   * @var \BotMan\BotMan\BotMan
   *
   * A Botman object.
   */
  protected $botman;


  /**
   * Constructs a BotmanChatbot plugin.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\botman\Listener\BotmanListener $ListenerService
   *   The listener service for botman.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, \Drupal\botman\Listener\BotmanListener $ListenerService) {
    $this->botman = $ListenerService->initialize();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration, $plugin_id, $plugin_definition,
      $container->get('botman.listener')
    );
  }

  public function listener() {
    $this->initialize();
    $this->botman->listen();
  }

  /**
   * {@inheritdoc}
   */
  public function initialize() {}

}
