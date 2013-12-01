<?php

namespace Albino\Container\Request;

use Albino\Container\iRequest;
use Albino\iDataHolder;
use Albino\DataHolder\iRequestHeader;
use Albino\iClient;

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
  public function createClientInstance();

  /**
   * @param array $data
   * @return iDataHolder
   */
  public function createFilesInstance(array $data = array());

  /**
   * @param array $data
   * @return iDataHolder
   */
  public function createBodyInstance(array $data = array());

  /**
   * @param array $data
   * @return iDataHolder
   */
  public function createQueryInstance(array $data = array());

  /**
   * @param array $data
   * @return iRequestHeader
   */
  public function createHeadersInstance(array $data = array());
}