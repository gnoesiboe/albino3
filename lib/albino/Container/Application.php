<?php

namespace Albino\Container;

use Albino\Container;
use Albino;

/**
 * Application class.
 *
 * @package    Albino
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Application extends Container implements iApplication
{

  /**
   * @see parent
   */
  protected function setDefaults()
  {
    parent::setDefaults();

    $this->set('router_class_name', 'Albino\Router');
    $this->set('path_class_name', 'Albino\DataHolder\Paths');
  }

  /**
   * @return Albino\Router
   */
  public function getRouter()
  {
    $className = $this->get('router_class_name');

    return new $className;
  }

  /**
   * @return Albino\DataHolder
   */
  public function getPath()
  {
    $className = $this->get('path_class_name');

    return new $className;
  }
}
