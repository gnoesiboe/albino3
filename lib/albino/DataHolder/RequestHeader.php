<?php

namespace Albino\DataHolder;

use Albino;

/**
 * Header class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
class RequestHeader extends Albino\DataHolder implements iRequestHeader
{

  /**
   * @return string
   */
  public function getHost()
  {
    return $this->doGet('host', false);
  }

  /**
   * @return string
   */
  public function getUserAgent()
  {
    return $this->doGet('user_agent', false);
  }

  /**
   * @return string
   */
  public function getContentType()
  {
    return $this->doGet('content_type', false);
  }
}