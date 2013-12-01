<?php

namespace Albino\Action;

use Albino\Action;
use Albino\iRequest;
use Albino\iResponse;
use Albino\Response;

/**
 * NotFound class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
class NotFound extends Action
{

  /**
   * @param iRequest $request
   * @return iResponse
   */
  public function execute(iRequest $request)
  {
    $response = new Response();
    $response
      ->setStatusCode(404)
      ->setContent('<h1>404 NOT FOUND</h1>')
    ;

    return $response;
  }
}