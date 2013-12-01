<?php

namespace Albino;

/**
 * iRouter class.
 *
 * @package    Albino3
 * @subpackage Router
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iRouter
{

  /**
   * @param iRequest $request
   * @return bool
   */
  public function match(iRequest $request);

  /**
   * @return iRoute
   */
  public function getCurrentRoute();
}
