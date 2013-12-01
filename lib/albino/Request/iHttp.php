<?php

namespace Albino\Request;

use Albino\iRequest;
use Albino\iClient;
use Albino\iDataHolder;
use Albino\DataHolder\iRequestHeader;

/**
 * iHttp class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
interface iHttp extends iRequest
{

  /**
   * @return iClient
   */
  public function getClient();

  /**
   * @return iDataHolder
   */
  public function getFiles();

  /**
   * @return string
   */
  public function getRawBody();

  /**
   * @return string
   */
  public function getMethod();

  /**
   * @return bool
   */
  public function isMultipart();

  /**
   * @return string
   */
  public function getMultipartBoundary();

  /**
   * @return iDataHolder
   */
  public function getQuery();

  /**
   * @return iRequestHeader
   */
  public function getHeaders();

  /**
   * @param string $method
   * @return bool
   */
  public function isMethod($method);

  /**
   * @return iDataHolder
   */
  public function getBody();
}