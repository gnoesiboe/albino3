<?php

namespace Lijflied;

use Albino;

/**
 * Action class.
 *
 * @package    Lijflied
 * @subpackage Action
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 *
 * @method Albino\View\Template getView
 */
abstract class Action extends Albino\Action
{

  /**
   * @see parent
   */
  protected function setup()
  {
    parent::setup();

    $this->setViewDefaults();
  }

  /**
   * Sets the defaults for the view
   */
  protected function setViewDefaults()
  {
    $this->getView()->setLayoutPath(dirname(__FILE__) . '/../../template/layout.php');
  }
}
