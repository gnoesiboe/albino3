<?php

namespace Albino;

/**
 * Inflector class.
 *
 * @package    Albino
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Inflector
{

  /**
   * @param string $string
   * @return string
   */
  public static function toCamelized($string)
  {
    $matches = array(
      '#/(.?)#e',
      '/(^|_|-)+(.)/e'
    );

    $replaceBy = array(
      "'::'.strtoupper('\\1')",
      "strtoupper('\\2')"
    );

    return preg_replace($matches, $replaceBy, $string);
  }

  /**
   * @param string $string
   * @return string
   */
  public static function toUnderscore($string)
  {
    $matches = array(
      '/([A-Z]+)([A-Z][a-z])/',
      '/([a-z\d])([A-Z])/'
    );

    $replaceBy = array(
      '\\1_\\2',
      '\\1_\\2'
    );

    return preg_replace($matches, $replaceBy, $string);
  }
}