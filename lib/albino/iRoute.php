<?php

namespace Albino;

use Albino\Request\iHttp;

/**
 * iRoute class.
 *
 * @package    Albino3
 * @subpackage Route
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iRoute
{

  /**
   * @param iRequest $request
   * @return bool
   */
  public function match(iRequest $request);

  /**
   * @return array
   */
  public function getParams();

  /**
   * @param string $key
   * @return bool
   */
  public function hasParam($key);

  /**
   * @param string $key
   * @param mixed $default
   *
   * @return string
   */
  public function getParam($key, $default = null);

  /**
   * @return string
   */
  public function getActionClassName();
}
