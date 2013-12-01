<?php

namespace Albino;

/**
 * Container class.
 *
 * Data holder used for service management
 *
 * @package    Albino
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Container extends DataHolder implements iContainer
{

  /**
   * @param array $data
   */
  public function __construct(array $data = array())
  {
    parent::__construct($data);

    $this->setDefaults();
  }

  /**
   * Set container defaults
   */
  protected function setDefaults()
  {
    // implement to add defaults
  }
}