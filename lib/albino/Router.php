<?php

namespace Albino;

use Albino;
use Albino\Route;
use Albino\Request;

/**
 * Router class.
 *
 * @package    Albino3
 * @subpackage Router
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Router extends DataHolder implements iRouter
{

  /**
   * @var iRoute
   */
  protected $currentRoute;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->setup();
    $this->configure();
  }

  /**
   * Setup this router
   */
  protected function setup()
  {
    // override to add your own logic
  }

  /**
   * Configure this router
   */
  protected function configure()
  {
    $this->setRoute('notfound', new Route\Regex(array(
      'action_class_name' => 'Albino\Action\NotFound', // @todo move to service container
      'pattern' => '/.*/'
    )));
  }

  /**
   * @param string $key
   * @param iRoute $route
   * @return Router
   */
  protected function setRoute($key, iRoute $route)
  {
    $this->validateIsValidRouteKey($key);
    $this->validateIsValidRoute($route);

    $this->set($key, $route);

    return $this;
  }

  /**
   * @param string $key
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidRouteKey($key)
  {
    if (is_string($key) === false)
    {
      throw new \UnexpectedValueException('Route key should be a string');
    }
  }

  /**
   * @param iRoute $route
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidRoute(iRoute $route)
  {
    // implement to add extra route requirements
  }

  /**
   * @param array $routes
   * @return Router
   */
  protected function setRoutes(array $routes)
  {
    foreach ($routes as $key => $value)
    {
      $this->setRoute($key, $value);
    }

    return $this;
  }

  /**
   * @param iRequest $request
   * @return bool
   */
  public function match(iRequest $request)
  {
    foreach ($this->values as $route)
    {
      /* @var iRoute $route */

      if ($route->match($request) === true)
      {
        $this->currentRoute = $route;

        return true;
      }
    }

    return false;
  }

  /**
   * Resets this router's routes
   *
   * @return Router
   */
  protected function reset()
  {
    $this->values = array();

    return $this;
  }

  /**
   * @return iRoute
   */
  public function getCurrentRoute()
  {
    return $this->currentRoute;
  }
}