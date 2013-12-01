<?php

namespace Albino\Container;

use Albino\iContainer;
use Albino\iDataHolder;
use Albino\iRouter;

/**
 * iApplication class.
 *
 * @package    Albino
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iApplication extends iContainer
{

  /**
   * @return iRouter
   */
  public function getRouter();

  /**
   * @return iDataHolder
   */
  public function getPath();
}