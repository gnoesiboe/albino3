<?php

namespace Albino\Validator;
use Albino\DataHolder;
use Albino\Validator;
use Albino\Exception;

/**
 * Regex class.
 *
 * @package    Albino3
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Regex extends Validator
{

  /**
   * Configures this validator's options
   */
  protected function configureOptions()
  {
    parent::configureOptions();

    $this->setOption('regex', null);
    $this->setRequiredOption('regex');
  }

  /**
   * Configures this validator's messages
   */
  protected function configureMessages()
  {
    parent::configureMessages();

    if ($this->messages->has('invalid') === false)
    {
      $this->messages->set('invalid', 'Value is not a valid email address');
    }
  }

  /**
   * @param string $input
   */
  public function validate($input)
  {
    parent::validate($input);

    $this->validateAgainstRegex($input, $this->getOption('regex'));
  }

  /**
   * @param string $input
   * @param string $regex
   *
   * @throws \Albino\Exception\Validator
   */
  protected function validateAgainstRegex($input, $regex)
  {
    if (preg_match($regex, $input) !== 1)
    {
      throw new Exception\Validator($this->messages->get('invalid'));
    }
  }

  /**
   * @param string $value
   * @throws \Albino\Exception
   */
  public function validateOptionRegex($value)
  {
    if (is_string($value) === false)
    {
      throw new Exception('No regex supplied for Regex validator');
    }
  }
}