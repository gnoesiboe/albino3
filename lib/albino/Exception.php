<?php

namespace Albino;

/**
 * Exception class.
 *
 * @package    Albino3
 * @subpackage Exception
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Exception extends \Exception
{

  /**
   * @param string $message
   * @param array $params
   */
  public function __construct($message = '', array $params = array())
  {
    parent::__construct($this->prepareMessage($message, $params));
  }

  /**
   * @param string $message
   * @param array $params
   *
   * @return string
   */
  protected function prepareMessage($message, array $params = array())
  {
    if (count($params) === 0)
    {
      return $message;
    }

    return strtr($message, $params);
  }
}
