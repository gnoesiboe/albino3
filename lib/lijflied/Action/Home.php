<?php

namespace Lijflied\Action;

use Lijflied;
use Albino;
use Albino\iRequest;
use Albino\iResponse;

/**
 * Homepage class.
 *
 * @package    Albino3
 * @subpackage Action
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 *
 * @method Albino\View\Template getView
 */
class Home extends Lijflied\Action
{

  /**
   * @param iRequest $request
   * @return iResponse
   */
  public function execute(iRequest $request)
  {
    $content = $this->getView()
      ->setTemplatePath($this->getApplication()->getPaths()->getTemplateRoot() . '/home.php')
      ->setData(array(
        'blogLatest' => $this->executeAction('Lijflied\Action\BlogLatest', $request),
      ))
      ->render()
    ;

    return new Albino\Response($content);
  }
}
