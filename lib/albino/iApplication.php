<?php

namespace Albino;

/**
 * iApplication class.
 *
 * @package    Albino3
 * @subpackage Application
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iApplication
{

  /**
   * @param iRequest $request
   * @return iResponse
   */
  public function handle(iRequest $request);

  /**
   * @return DataHolder\iPaths
   */
  public function getPaths();

  /**
   * @return iRouter
   */
  public function getRouter();
}
