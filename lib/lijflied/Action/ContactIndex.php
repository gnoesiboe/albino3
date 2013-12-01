<?php

namespace Lijflied\Action;

use Albino\Exception;
use Albino\iRequest;
use Albino\Request\iHttp;
use Albino\iResponse;
use Albino\Request;
use Albino\Response;
use Lijflied\Action;

/**
 * ContactForm class.
 *
 * @package    Lijflied
 * @subpackage Action
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class ContactIndex extends Action
{

  /**
   * @param iRequest $request
   * @return iResponse|string
   */
  public function execute(iRequest $request)
  {
    /* @var iHttp $request */

    $this->handleFormSubmission($request);

    $content = $this->getView()
      ->setTemplatePath($this->getApplication()->getPaths()->getTemplateRoot() . '/contact/index.php')
      ->setData(array(
        'seoTitle' => 'Contact - '
      ), true)
      ->render()
    ;

    return new Response($content);
  }

  /**
   * @param iHttp $request
   */
  protected function handleFormSubmission(iHttp $request)
  {
    $input = array();
    $errors = array();
    $success = null;

    if ($request->isMethod(Request\Http::METHOD_POST) === true && $request->getBody()->has('contact') === true)
    {
      $input = $request->getBody()->get('contact');

      $schema = new \Lijflied\Validator\Schema\Contact();

      try
      {
        $schema->validate($input);

        $success = true;

        $now = new \DateTime();
        $message = <<<EBODY
hey Christel,

er is een contactaanvraag ingeschoten op Lijflied.com op {$now->format('d-m-Y H:i\u')}

INFORMATIE:
naam: {$input['name']}
e-mailadres: {$input['email']}
boodschap: {$input['message']}

x - het robotje van Lijflied.com

EBODY;
;

        $headers = 'From: no-reply@lijflied.com';

        mail('Christel van der Bruggen - Lijflied <info@lijflied.com>, Gijs Nieuwenhuis <gijsnieuwenhuis@gmail.com>', 'Contactaanvraag via Lijflied.com', $message, $headers);
      }
      catch (Exception\Validator\Scheme $e)
      {
        $success = false;
        $errors = $e->getChildMessages();
      }
    }

    $this->getView()
      ->set('input', $input)
      ->set('errors', $errors)
      ->set('success', $success)
    ;
  }
}