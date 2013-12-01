<?php

namespace Albino;

/**
 * iConfigurable class.
 *
 * @package    Albino3
 * @subpackage Configurable
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iConfigurable
{

  /**
   * @param string $key
   * @return mixed
   */
  public function getOption($key);

  /**
   * @param string $key
   * @return bool
   */
  public function hasOption($key);

  /**
   * @param array $options
   * @return iConfigurable
   */
  public function setOptions(array $options);

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return iConfigurable
   */
  public function setOption($key, $value);

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return bool
   */
  public function isValidValueForKey($key, $value);

  /**
   * @param string $key
   * @return bool
   */
  public function isValidKey($key);

  /**
   * * @return iConfigurable
   */
  public function validateRequiredOptionsSet();

  /**
   * @return iConfigurable
   */
  public function validateOptionValues();

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return iConfigurable
   */
  public function validateOptionValue($key, $value);

  /**
   * @param string $key
   * @return bool
   */
  public function hasRequiredOption($key);
}