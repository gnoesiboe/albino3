<?php

namespace Albino\Validator;

use Albino\iValidator;
use Albino\Validator;
use Albino\DataHolder;
use Albino\Exception;

/**
 * Schema class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
abstract class Schema extends Validator
{

  /**
   * @var DataHolder
   */
  protected $validatorHolder;

  /**
   * Configures this validator schema
   */
  protected function configure()
  {
    parent::configure();

    $this->configureValidatorHolder();
  }

  /**
   * Configures this schema's validator holder
   */
  protected function configureValidatorHolder()
  {
    $this->validatorHolder = new DataHolder();
  }

  /**
   * @param string $key
   * @return Validator
   */
  public function getValidator($key)
  {
    return $this->validatorHolder->get($key);
  }

  /**
   * @param string $key
   * @param iValidator $validator
   */
  public function setValidator($key, iValidator $validator)
  {
    $this->validatorHolder->set($key, $validator);
  }

  /**
   * @return DataHolder
   */
  public function getValidators()
  {
    return $this->validatorHolder;
  }
}