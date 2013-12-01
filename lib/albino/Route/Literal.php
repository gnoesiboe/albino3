<?php

namespace Albino\Route;

use Albino\iRequest;
use Albino\Route;

/**
 * Literal class.
 *
 * @package    Albino
 * @subpackage Route
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Literal extends Route
{

  /**
   * @param iRequest $request
   * @return bool
   */
  public function match(iRequest $request)
  {
    if ($request->getPath() === $this->getPattern())
    {
      return true;
    }

    return false;
  }
}
