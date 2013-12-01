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
class ClassesSongwriting extends Action
{

  /**
   * @param iRequest $request
   * @return iResponse|string
   */
  public function execute(iRequest $request)
  {
    /* @var iHttp $request */

    $content = $this->getView()
      ->setTemplatePath($this->getApplication()->getPaths()->getTemplateRoot() . '/classes/songwriting.php')
      ->setData(array(
        'seoTitle' => 'Songwritingles - ',
      ))
      ->render()
    ;

    return new Response($content);
  }
}
 