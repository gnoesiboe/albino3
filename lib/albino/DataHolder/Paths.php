<?php

namespace Albino\DataHolder;

use Albino\DataHolder;

/**
 * Paths class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Paths extends DataHolder implements iPaths
{

  /**
   * @return string
   */
  public function getApplicationRoot()
  {
    return $this->doGet('application_root');
  }

  /**
   * @return string
   */
  public function getTemplateRoot()
  {
    return $this->doGet('template_root');
  }
}
