<?php

namespace Albino;

use Albino\iRequest;

/**
 * iAction class.
 *
 * @package    Albino2
 * @subpackage Action
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iAction
{

  /**
   * @param iRequest $request
   * @return iResponse|string
   */
  public function execute(iRequest $request);
}