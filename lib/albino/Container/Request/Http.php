<?php

namespace Albino\Container\Request;

use Albino\Container\Request;
use Albino\DataHolder\iRequestHeader;
use Albino\iDataHolder;

/**
 * Http class.
 *
 * @package    Albino3
 * @subpackage Container
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Http extends Request implements iHttp
{

  /**
   * @see parent
   */
  protected function setDefaults()
  {
    parent::setDefaults();

    $this->set('client_class_name', 'Albino\Client');
    $this->set('files_class_name', 'Albino\DataHolder');
    $this->set('body_class_name', 'Albino\DataHolder');
    $this->set('query_class_name', 'Albino\DataHolder');
    $this->set('headers_class_name', 'Albino\DataHolder\RequestHeader');
  }

  /**
   * @return \Albino\iClient
   */
  public function createClientInstance()
  {
    $className = $this->get('client_class_name');

    return new $className();
  }

  /**
   * @param array $data
   * @return iDataHolder
   */
  public function createFilesInstance(array $data = array())
  {
    $className = $this->get('files_class_name');

    return new $className($data);
  }

  /**
   * @param array $data
   * @return iDataHolder
   */
  public function createBodyInstance(array $data = array())
  {
    $className = $this->get('body_class_name');

    return new $className($data);
  }

  /**
   * @param array $data
   * @return iDataHolder
   */
  public function createQueryInstance(array $data = array())
  {
    $className = $this->get('query_class_name');

    return new $className($data);
  }

  /**
   * @param array $data
   * @return iRequestHeader
   */
  public function createHeadersInstance(array $data = array())
  {
    $className = $this->get('headers_class_name');

    return new $className($data);
  }
}