<?php

namespace Albino\Validator\Regex;
use Albino\Validator\Regex;

/**
 * Email class.
 *
 * @package    Albino3
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Email extends Regex
{

  /**
   * Configures this validator's options
   */
  protected function configureOptions()
  {
    parent::configureOptions();

    $this->setOption('regex', '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i');
  }
}
