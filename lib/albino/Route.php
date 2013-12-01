<?php

namespace Albino;

/**
 * Route class.
 *
 * @package    Albino3
 * @subpackage Route
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
abstract class Route extends Configurable implements iRoute
{

  /**
   * @var array
   */
  protected $requiredOptions = array('action_class_name', 'pattern');

  /**
   * @var array
   */
  protected $params = array();

  /**
   * @param array $options
   */
  public function __construct(array $options = array())
  {
    parent::__construct($options);

    $this->validateRequiredOptionsSet();
  }

  /**
   * @return string
   */
  protected function getPattern()
  {
    return $this->getOption('pattern');
  }

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return Route
   */
  protected function setParam($key, $value)
  {
    $this->params[$key] = $value;

    return $this;
  }

  /**
   * @return array
   */
  public function getParams()
  {
    return $this->params;
  }

  /**
   * @param string $key
   * @param mixed $default
   *
   * @return string
   */
  public function getParam($key, $default = null)
  {
    return $this->hasParam($key) === true ? $this->params[$key] : $default;
  }

  /**
   * @param string $key
   * @return bool
   */
  public function hasParam($key)
  {
    return array_key_exists($key, $this->params);
  }

  /**
   * @return string
   */
  public function getActionClassName()
  {
    return $this->getOption('action_class_name');
  }
}