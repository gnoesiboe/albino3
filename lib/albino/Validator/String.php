<?php

namespace Albino\Validator;

use Albino\DataHolder;
use Albino\Validator;
use Albino\Exception;

/**
 * String class.
 *
 * @package    ALbino3
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class String extends Validator
{

  /**
   * Configures the options of this validator
   */
  protected function configureOptions()
  {
    parent::configureOptions();

    $this->setOption('min_length', null);
    $this->setOption('max_length', null);
  }

  /**
   * Configures the messages of this validator
   */
  protected function configureMessages()
  {
    parent::configureMessages();

    $this->messages->set('invalid', 'Value should be a string');
    $this->messages->set('min_length', 'String should be at least %min_length% characters');
    $this->messages->set('max_length', 'String should be at most %max_length% characters');
  }

  /**
   * @param string $input
   * @throws \Albino\Exception\Validator
   */
  public function validate($input)
  {
    parent::validate($input);

    $this->validateIsString($input);
    $this->validateMinLength($input);
    $this->validateMaxLength($input);
  }

  /**
   * @param string $input
   * @throws \Albino\Exception\Validator
   */
  protected function validateIsString($input)
  {
    if (is_string($input) === false)
    {
      throw new Exception\Validator($this->messages->get('invalid'));
    }
  }

  /**
   * @param string $input
   * @throws \Albino\Exception\Validator
   */
  protected function validateMinLength($input)
  {
    $minLength = $this->getOption('min_length');

    if (is_numeric($minLength) === false)
    {
      return;
    }

    if (strlen($input) < $minLength)
    {
      throw new Exception\Validator($this->messages->get('min_length'), array('%min_length%' => $minLength));
    }
  }

  /**
   * @param string $input
   * @throws \Albino\Exception\Validator
   */
  protected function validateMaxLength($input)
  {
    $maxLength = $this->getOption('max_length');

    if (is_numeric($maxLength) === false)
    {
      return;
    }

    if (is_numeric($maxLength) === true && strlen($input) > $maxLength)
    {
      throw new Exception\Validator($this->messages->get('max_length'), array('%max_length%' => $maxLength));
    }
  }

  /**
   * @param mixed $value
   * @throws \Albino\Exception
   */
  protected function validateOptionMinLength($value)
  {
    if (is_null($value) === false && is_numeric($value) === false)
    {
      throw new Exception('The min_length option is to be a numeric value');
    }
  }

  /**
   * @param mixed $value
   * @throws \Albino\Exception
   */
  protected function validateOptionMaxLength($value)
  {
    if (is_null($value) === false && is_numeric($value) === false)
    {
      throw new Exception('The max_length option is to be a numeric value');
    }
  }
}