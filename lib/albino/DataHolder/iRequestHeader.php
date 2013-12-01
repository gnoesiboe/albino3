<?php

namespace Albino\DataHolder;

use Albino\iDataHolder;

/**
 * iRequestHeader class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
interface iRequestHeader extends iDataHolder
{

  /**
   * @return string
   */
  public function getHost();

  /**
   * @return string
   */
  public function getUserAgent();

  /**
   * @return string
   */
  public function getContentType();
}