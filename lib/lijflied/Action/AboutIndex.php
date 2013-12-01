<?php

namespace Lijflied\Action;

use Albino\iRequest;
use Albino\Request\iHttp;
use Albino\iResponse;
use Albino\Response;
use Lijflied\Action;

/**
 * BlogIndex class.
 *
 * @package    Lijflied
 * @subpackage Action
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class AboutIndex extends Action
{

  /**
   * @param iRequest $request
   * @return iResponse|string
   */
  public function execute(iRequest $request)
  {
    /* @var iHttp $request */

    $content = $this->getView()
      ->setTemplatePath($this->getApplication()->getPaths()->getTemplateRoot() . '/about/index.php')
      ->setData(array(
        'seoTitle' => 'Over lijflied - ',
        'ogType' => 'company'
      ))
      ->render()
    ;

    return new Response($content);
  }
}
 