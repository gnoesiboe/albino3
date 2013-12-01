<?php

namespace Albino;

/**
 * Client class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
class Client implements iClient
{

  /**
   * @var \iUser
   */
  protected $user = null;

  /**
   * @var bool
   */
  protected $isAuthenticated = false;

  /**
   * @var array
   */
  protected $permissions = array();

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->reset();
  }

  /**
   * @return bool
   */
  public function isAuthenticated()
  {
    return $this->isAuthenticated;
  }

  /**
   * Do authenticate this client
   *
   * @return Client
   */
  public function authenticate()
  {
    $this->isAuthenticated = true;

    return $this;
  }

  /**
   * @param iUser $user
   * @return Client
   */
  public function setUser(iUser $user)
  {
    $this->user = $user;

    return $this;
  }

  /**
   * @param array $permissions
   * @return Client
   */
  public function authorize(array $permissions = array())
  {
    $this->setPermissions($permissions);

    return $this;
  }

  /**
   * @param array $permissions
   * @return Client
   */
  public function addPermissions(array $permissions)
  {
    foreach ($permissions as $permission)
    {
      /* @var string $permission */

      $this->addPermission($permission);
    }

    return $this;
  }

  /**
   * @param string $permission
   * @return bool
   */
  public function hasPermission($permission)
  {
    return in_array($permission, $this->permissions);
  }

  /**
   * @param array $permissions
   * @return Client
   */
  public function setPermissions(array $permissions)
  {
    $this->resetPermissions();
    $this->addPermissions($permissions);
  }

  /**
   * Resets the permissions this client has
   *
   * @return Client
   */
  public function resetPermissions()
  {
    $this->permissions = array();

    return $this;
  }

  /**
   * @param string $permission
   * @return Client
   */
  public function addPermission($permission)
  {
    $this->validateIsValidPermission($permission);
    $this->permissions[] = $permission;

    return $this;
  }

  /**
   * @param string $permission
   * @throws \UnexpectedValueException
   */
  protected function validateIsValidPermission($permission)
  {
    if (is_string($permission) === false)
    {
      throw new \UnexpectedValueException('Permission should be of type string');
    }
  }

  /**
   * De-authenticates this client
   *
   * @return Client
   */
  public function deAuthenticate()
  {
    $this->reset();

    return $this;
  }

  /**
   * Resets this client
   */
  protected function reset()
  {
    $this->user = null;
    $this->isAuthenticated = false;
    $this->resetPermissions();
  }
}