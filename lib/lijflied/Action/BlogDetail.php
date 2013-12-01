<?php

namespace Lijflied\Action;

use Albino\iRequest;
use Albino\Request\iHttp;
use Albino\iResponse;
use Albino\Response;
use Lijflied\Action;
use Albino\Exception\PageNotFoundException;

/**
 * BlogIndex class.
 *
 * @package    Lijflied
 * @subpackage Action
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class BlogDetail extends Action
{

  /**
   * @param iRequest $request
   * @return iResponse|Response|string
   *
   * @throws \Albino\Exception\PageNotFoundException
   */
  public function execute(iRequest $request)
  {
    /* @var iHttp $request */

    $file = $this->getApplication()->getRouter()->getCurrentRoute()->getParam('file') . '.php';
    $path = $this->getApplication()->getPaths()->getTemplateRoot() . '/blog/' . $file;

    if (file_exists($path) === false)
    {
      throw new PageNotFoundException();
    }

    $content = $this->getView()
      ->setTemplatePath($path)
      ->setData(array(
        'seoTitle' => 'Blog - ',
        'ogType' => 'article'
      ))
      ->render()
    ;

    return new Response($content);
  }
}
 