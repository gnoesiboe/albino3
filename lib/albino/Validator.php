<?php

namespace Albino;

use Albino\iValidator;

/**
 * Validator class.
 *
 * @package    Albino
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
abstract class Validator extends Configurable implements iValidator
{

  /**
   * @var \Albino\DataHolder
   */
  protected $messages;

  /**
   * @param array $options
   * @param array $messages
   */
  public function __construct(array $options = array(), array $messages = array())
  {
    $this->setOptions($options);
    $this->setMessages($messages);

    $this->configure();

    $this->validateRequiredOptionsSet();
    $this->validateOptionValues();
  }

  /**
   * @param array $messages
   */
  public function setMessages(array $messages)
  {
    $this->messages = new DataHolder($messages);
  }

  /**
   * Configures this validator
   */
  protected function configure()
  {
    $this->configureMessages();
    $this->configureOptions();
  }

  /**
   * Configures the options of this validator
   */
  protected function configureOptions()
  {
    $this->setOption('required', true);
    $this->setRequiredOption('required');
  }

  /**
   * Configures the messages of this validator
   */
  protected function configureMessages()
  {
    if ($this->messages->has('required') === false)
    {
      $this->messages->set('required', 'Field is required');
    }
  }

  /**
   * @param string $input
   */
  public function validate($input)
  {
    $this->validateRequired($input);
  }

  /**
   * @param string $input
   * @throws Exception\Validator
   */
  protected function validateRequired($input)
  {
    if ($this->getOption('required') === true && empty($input) === true)
    {
      throw new Exception\Validator($this->messages->get('required'));
    }
  }

  /**
   * @param string $value
   * @throws Exception
   */
  protected function validateOptionRequired($value)
  {
    if (is_bool($value) === false)
    {
      throw new Exception('The required option is to be a boolean value');
    }
  }
}