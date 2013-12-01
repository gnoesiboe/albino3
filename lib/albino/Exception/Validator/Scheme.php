<?php

namespace Albino\Exception\Validator;

use Albino\Exception\Validator;

/**
 * Scheme class.
 *
 * @package    Albino3
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Scheme extends Validator
{

  /**
   * @var array
   */
  protected $childMessages;

  /**
   * @param string $message
   * @param array $params
   * @param array $childMessages
   */
  public function __construct($message = '', array $params = array(), array $childMessages = array())
  {
    parent::__construct($message, $params);

    $this->childMessages = $childMessages;
  }

  /**
   * @return array
   */
  public function getChildMessages()
  {
    return $this->childMessages;
  }
}
