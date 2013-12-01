<?php

namespace Albino;
use Traversable;

/**
 * DataHolder class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
class DataHolder implements iDataHolder, \IteratorAggregate, \Countable
{

  /**
   * @var array
   */
  protected $values;

  /**
   * @param array $data
   */
  public function __construct(array $data = array())
  {
    $this->setData($data);
  }

  /**
   * @return array
   */
  public function getValues()
  {
    return $this->values;
  }

  /**
   * @param string $key
   * @return mixed
   */
  public function get($key)
  {
    $value = $this->getFromGetterMethod($key);

    if (is_null($value) === true)
    {
      $value = $this->doGet($key);
    }

    return $value;
  }

  /**
   * @param string $key         Key date is searched for
   * @param bool $validate      Wether or not to validate if this key exists on this data holder
   *
   * @return mixed
   */
  protected function doGet($key, $validate = true)
  {
    if ($validate === true)
    {
      $this->validateHas($key);
    }
    elseif ($this->has($key) === false)
    {
      return null;
    }

    return $this->values[$key];
  }

  /**
   * @param string $key
   * @return mixed
   */
  protected function getFromGetterMethod($key)
  {
    $method = self::generateGetterMethod($key);

    if ($this->checkInstanceMethodExists($method) === true)
    {
      return $this->$method();
    }

    if ($this->checkStaticMethodExists($method) === true)
    {
      return self::$method();
    }

    return null;
  }

  /**
   * @param string $method
   * @return bool
   */
  protected function checkInstanceMethodExists($method)
  {
    return method_exists($this, $method);
  }

  /**
   * @param string $method
   * @return bool
   */
  protected function checkStaticMethodExists($method)
  {
    return method_exists(get_class($this), $method);
  }

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return Container
   */
  public function set($key, $value)
  {
    $this->validateIsValidKey($key);
    $this->values[$key] = $value;

    return $this;
  }

  /**
   * @param string $key
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidKey($key)
  {
    if ($this->isValidKey($key) === false)
    {
      throw new \UnexpectedValueException('Key of a DataHolder should be of type: string');
    }
  }

  /**
   * @param string $key
   * @return bool
   */
  public function isValidKey($key)
  {
    return is_string($key);
  }

  /**
   * @param array $data
   * @param bool $merge
   *
   * @return DataHolder
   */
  public function setData(array $data, $merge = false)
  {
    $this->validateValidDataArray($data);
    $this->values = $merge === true ? array_merge($this->values, $data) : $data;

    return $this;
  }

  /**
   * @param array $data
   * @return bool
   */
  protected function validateValidDataArray(array $data)
  {
    foreach ($data as $key => $value)
    {
      $this->validateIsValidKey($key);
      $this->validateIsValidValue($value);
    }
  }

  /**
   * @param mixed $value
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidValue($value)
  {
    if ($this->isValidValue($value) === false)
    {
      throw new \UnexpectedValueException('Value not valid for DataHolder');
    }
  }

  /**
   * @param string $value
   * @return bool
   */
  public function isValidValue($value)
  {
    // no restrictions at this point. Override to add your own restrictions
    return true;
  }

  /**
   * @param string $key
   * @return string
   */
  protected static function generateGetterMethod($key)
  {
    return 'get' . Inflector::toCamelized($key);
  }

  /**
   * @param string $key
   * @return bool
   */
  public function has($key)
  {
    return array_key_exists($key, $this->values);
  }

  /**
   * @param string $key
   * @throws \Exception
   * @return DataHolder
   */
  public function validateHas($key)
  {
    if ($this->has($key) === false)
    {
      throw new Exception(sprintf('This container has no value with key: %s', $key));
    }

    return $this;
  }

  /**
   * Counts elements of this data holder
   *
   * @return int
   */
  public function count()
  {
    return count($this->values);
  }

  /**
   * Returns the iterator that is used to iterate over this
   * data holder's collection.
   *
   * @return \Traversable
   */
  public function getIterator()
  {
    return new \ArrayIterator($this->values);
  }
}
