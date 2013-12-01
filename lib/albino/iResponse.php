<?php

namespace Albino;

/**
 * iResponse class.
 *
 * @package    Albino
 * @subpackage response
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iResponse
{

  /**
   * Sends the response back to the client
   */
  public function send();
}