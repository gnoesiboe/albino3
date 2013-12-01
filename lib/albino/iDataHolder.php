<?php

namespace Albino;

/**
 * iDataHolder class.
 *
 * @package    Albino3
 * @subpackage Albino
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iDataHolder
{

  /**
   * @param string $key
   * @return mixed
   */
  public function get($key);

  /**
   * @return array
   */
  public function getValues();

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return iDataHolder
   */
  public function set($key, $value);

  /**
   * @param string $key
   * @return bool
   */
  public function isValidKey($key);

  /**
   * @param array $data
   * @param bool $merge
   *
   * @return iDataHolder
   */
  public function setData(array $data, $merge = false);

  /**
   * @param mixed $value
   * @return bool
   */
  public function isValidValue($value);

  /**
   * @param string $key
   * @return bool
   */
  public function has($key);

  /**
   * @param string $key
   * @throws \Exception
   * @return iDataHolder
   */
  public function validateHas($key);
}