<?php

namespace Albino\DataHolder;

/**
 * iPaths class.
 *
 * @package    Albino3
 * @subpackage DataHolder
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
interface iPaths
{

  /**
   * @return string
   */
  public function getApplicationRoot();

  /**
   * @return string
   */
  public function getTemplateRoot();
}