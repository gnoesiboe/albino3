<?php

namespace Lijflied\Validator\Schema;

use Albino\Validator\Schema;
use Albino\Validator;
use Albino\Exception;
use Albino\DataHolder;

/**
 * Contact class.
 *
 * @package    Albino3
 * @subpackage Validator
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Contact extends Schema
{

  /**
   * Configures this validator schema
   */
  protected function configure()
  {
    parent::configure();

    $this->configureValidators();
  }

  /**
   * Configures this scheme's messages
   */
  protected function configureMessages()
  {
    parent::configureMessages();

    $this->messages->set('invalid', 'Een of meerdere velden voldoen niet aan de voorwaarden');
  }

  /**
   * Configures this schema's validators
   */
  protected function configureValidators()
  {
    $requiredMessage = 'Dit veld is verplicht';

    $this->setValidator('name', new Validator\String(array(), array('required' => $requiredMessage)));
    $this->setValidator('email', new Validator\Regex\Email(array(), array(
      'required' => $requiredMessage,
      'invalid' => 'Vul een geldig emailadres in'
    )));
    $this->setValidator('message', new Validator\String(array(), array('required' => $requiredMessage)));
  }

  /**
   * @param array $input
   * @throws \Albino\Exception\Validator\Scheme
   */
  public function validate($input)
  {
    $errors = array();

    foreach ($this->getValidators() as $key => $validator)
    {
      /* @var \Albino\iValidator $validator */

      try
      {
        $validator->validate(isset($input[$key]) === true ? $input[$key] : null);
      }
      catch (Exception\Validator $e)
      {
        $errors[$key] = $e->getMessage();
      }
    }

    if (count($errors) > 0)
    {
      throw new Exception\Validator\Scheme($this->messages->get('invalid'), array(), $errors);
    }
  }
}