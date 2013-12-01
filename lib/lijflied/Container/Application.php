<?php

namespace Lijflied\Container;

use Albino;

/**
 * Application class.
 *
 * @package    Albino3
 * @subpackage Container
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Application extends Albino\Container\Application
{

  /**
   * @see parent
   */
  protected function setDefaults()
  {
    parent::setDefaults();

    $this->set('router_class_name', 'Lijflied\Router');
  }
}