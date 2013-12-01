<?php

namespace Albino;

/**
 * Configurable class.
 *
 * @package    Albino3
 * @subpackage Configurable
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
abstract class Configurable implements iConfigurable
{

  /**
   * @var array
   */
  protected $requiredOptions = array();

  /**
   * @var array
   */
  protected $options = array();

  /**
   * @param array $options
   */
  public function __construct(array $options = array())
  {
    $this->setOptions($options);
  }

  /**
   * @param string $key
   * @return mixed
   */
  public function getOption($key)
  {
    $this->validateHasOption($key);

    return $this->options[$key];
  }

  /**
   * @param string $key
   * @throws /Exception
   */
  protected function validateHasOption($key)
  {
    if ($this->hasOption($key) === false)
    {
      throw new \Exception(sprintf('No option with key: %s set', $key));
    }
  }

  /**
   * @param string `$key
   * @return bool
   */
  public function hasOption($key)
  {
    return array_key_exists($key, $this->options);
  }

  /**
   * @param array $options
   * @return Configurable
   */
  public function setOptions(array $options)
  {
    foreach ($options as $key => $value)
    {
      $this->setOption($key, $value);
    }

    return $this;
  }

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return Configurable
   */
  public function setOption($key, $value)
  {
    $this->validateIsValidKey($key);
    $this->validateIsValidValueForKey($key, $value);

    $this->options[$key] = $value;

    return $this;
  }

  /**
   * @param string $key
   * @param mixed $value
   *
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidValueForKey($key, $value)
  {
    if ($this->isValidValueForKey($key, $value) === false)
    {
      throw new \UnexpectedValueException('Value not allowed for key: ' . $key);
    }
  }

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return bool
   */
  public function isValidValueForKey($key, $value)
  {
    return true;
  }

  /**
   * @param string $key
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidKey($key)
  {
    if ($this->isValidKey($key) === false)
    {
      throw new \UnexpectedValueException('Configurable key is invalid');
    }
  }

  /**
   * @param string $key
   * @return bool
   */
  public function isValidKey($key)
  {
    return is_string($key) === true;
  }

  /**
   * @return bool
   * @return Configurable
   *
   * @throws \Albino\Exception
   */
  public function validateRequiredOptionsSet()
  {
    foreach ($this->getRequiredOptions() as $key)
    {
      /* @var string $key */

      $this->validateHasOption($key);

      // required option should have a value
      if (is_null($this->getOption($key)) === true)
      {
        throw new Exception('Required option: %key% should have a value', array('%key%' => $key));
      }
    }

    return $this;
  }

  /**
   * @return Configurable
   */
  public function validateOptionValues()
  {
    foreach ($this->options as $key => $value)
    {
      $this->validateOptionValue($key, $value);
    }

    return $this;
  }

  /**
   * @param string $key
   * @return bool
   */
  public function isRequiredOption($key)
  {
    return array_key_exists($key, $this->requiredOptions);
  }

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return Configurable
   */
  public function validateOptionValue($key, $value)
  {
    $method = 'validateOption' . Inflector::toCamelized($key);

    if (method_exists($this, $method) === true)
    {
      $this->$method($value);
    }

    return $this;
  }

  /**
   * @return array
   */
  protected function getRequiredOptions()
  {
    return $this->requiredOptions;
  }

  /**
   * @param string $key
   * @return Configurable
   */
  protected function setRequiredOption($key)
  {
    $this->validateHasOption($key);

    if ($this->hasRequiredOption($key) === false)
    {
      $this->requiredOptions[] = $key;
    }

    return $this;
  }

  /**
   * @param string $key
   * @return bool
   */
  public function hasRequiredOption($key)
  {
    return in_array($key, $this->requiredOptions);
  }
}
