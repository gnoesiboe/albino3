<?php

namespace Albino\Response;

use Albino\Response;

/**
 * Redirect class.
 *
 * @package    Albino3
 * @subpackage Response
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Redirect extends Response
{

  /**
   * @return array
   */
  protected function getDefaults()
  {
    return array_merge(parent::getDefaults(), array(
      'statusCode' => 307,
      'statusText' => $this->statusCodes[307]
    ));
  }

  /**
   * @param string $url
   * @return Response\Redirect
   */
  public function to($url)
  {
    $this->setHeader('Location', $url);

    return $this;
  }
}
