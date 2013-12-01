<?php

namespace Albino;

use Albino\Container;
use Albino\Exception\PageNotFoundException;
use Albino\iAction;

/**
 * application class.
 *
 * @package    Albino
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class application implements iApplication
{

  /**
   * @var string
   */
  const DEFAULT_ENVIRONMENT = 'prod';

  /**
   * @var iApplication
   */
  protected $container;

  /**
   * @var iRouter
   */
  protected $router;

  /**
   * @var iDataHolder
   */
  protected $paths;

  /**
   * @var string
   */
  protected $environment = self::DEFAULT_ENVIRONMENT;

  /**
   * @param string $environment
   * @param Container\iApplication $container
   *
   * @todo pass configuration
   */
  public function __construct($environment, Container\iApplication $container)
  {
    $this->container = $container;

    $this->configure();
  }

  /**
   * @param string $environment
   */
  protected function setEnvironment($environment)
  {
    $this->environment = $environment;
  }

  /**
   * @param iRequest $request
   * @return iResponse
   *
   * @throws \UnexpectedValueException
   */
  public function handle(iRequest $request)
  {
    $router = $this->getRouter();

    if ($router->match($request) === false)
    {
      throw new \UnexpectedValueException('No route matches. Insert a fallback route.');
    }

    $currentRoute = $router->getCurrentRoute();

    $action = $this->createAction($currentRoute->getActionClassName());

    try
    {
      $response = $action->execute($request, $currentRoute->getParams());
    }
    catch (PageNotFoundException $e)
    {
      // @todo style propertly
      header('HTTP/1.0 404 Not Found');
      exit();
    }

    $this->validateIsValidActionResponse($response);

    return $response;
  }

  /**
   * @param mixed $response
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidActionResponse($response)
  {
    if (is_null($response) === true)
    {
      throw new \UnexpectedValueException('Action did not return a response');
    }


    if (($response instanceof iResponse) === false)
    {
      throw new \UnexpectedValueException('Response should implement the iResponse interface');
    }
  }

  /**
   * @return iRouter
   */
  public function getRouter()
  {
    if (is_object($this->router) && $this->router instanceof iRouter)
    {
      return $this->router;
    }

    $this->router = $this->container->getRouter();
    return $this->getRouter();
  }

  /**
   * @param string $actionClassName
   * @return iAction
   * @throws \UnexpectedValueException
   */
  protected function createAction($actionClassName)
  {
    $instance = new $actionClassName($this);

    if (($instance instanceof iAction) === false)
    {
      throw new \UnexpectedValueException('Action should implement the iAction interface');
    }

    return $instance;
  }

  /**
   * Set's this application up
   */
  protected function configure()
  {
    $this->configurePaths();
  }

  /**
   * Configures this application's paths
   *
   * @throws \UnexpectedValueException
   */
  protected function configurePaths()
  {
    $instance = $this->container->getPath();

    if (($instance instanceof DataHolder\iPaths) === false)
    {
      throw new \UnexpectedValueException('Path instance should implement the DataHolder\iPaths interface');
    }

    /* @var iDataHolder $instance */

    $instance->setData(array(
      'application_root' => $this->getApplicationRootPath(),
      'template_root' => $this->getTemplateRoot()
    ));

    $this->paths = $instance;
  }

  /**
   * @return iDataHolder
   */
  public function getPaths()
  {
    return $this->paths;
  }

  /**
   * @return string
   */
  public function getTemplateRoot()
  {
    return $this->getApplicationRootPath() . '/template';
  }

  /**
   * @return string
   */
  protected function getApplicationRootPath()
  {
    return realpath(dirname(__FILE__) . '/../../');
  }
}