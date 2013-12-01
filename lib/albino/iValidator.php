<?php

namespace Albino;

/**
 * iValidator class.
 *
 * @package    Albino3
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iValidator extends iConfigurable
{

  /**
   * @param string $input
   */
  public function validate($input);
}