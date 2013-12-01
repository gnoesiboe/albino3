<?php

namespace Albino;

use Albino\iAction;

/**
 * Action class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
abstract class Action implements iAction
{

  /**
   * @var iApplication
   */
  protected $application;

  /**
   * @var iView
   */
  protected $view;

  /**
   * @param iApplication $application
   */
  public function __construct(iApplication $application)
  {
    $this->application = $application;

    $this->setup();
  }

  /**
   * Setup this action
   */
  protected function setup()
  {
    $this->initView();
  }

  /**
   * Initiates the view for this action
   */
  protected function initView()
  {
    // @todo move to dependency container
    $this->view = new View\Template();
  }

  /**
   * @return iView
   */
  protected function getView()
  {
    return $this->view;
  }

  /**
   * @return iApplication
   */
  protected function getApplication()
  {
    return $this->application;
  }

  /**
   * @param string $action
   * @param iRequest $request
   *
   * @return iResponse|string
   */
  protected function executeAction($action, iRequest $request)
  {
    /* @var iAction $action */
    $action = new $action($this->getApplication());

    return $action->execute($request);
  }
}