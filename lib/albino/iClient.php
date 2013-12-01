<?php

namespace Albino;

/**
 * iClient class.
 *
 * @package    <package> 
 * @subpackage <subpackage
 * @author     <author>
 * @copyright  Freshheads BV
 */
interface iClient
{

  /**
   * @return bool
   */
  public function isAuthenticated();

  /**
   * @return iClient
   */
  public function authenticate();

  /**
   * @param iUser $user
   * @return iClient
   */
  public function setUser(iUser $user);

  /**
   * @param array $permissions
   * @return iClient
   */
  public function authorize(array $permissions = array());

  /**
   * @param array $permissions
   * @return iClient
   */
  public function addPermissions(array $permissions);

  /**
   * @param mixed $permission
   * @return bool
   */
  public function hasPermission($permission);

  /**
   * @param array $permissions
   * @return iClient
   */
  public function setPermissions(array $permissions);

  /**
   * @return iClient
   */
  public function resetPermissions();

  /**
   * @param mixed $permission
   * @return iClient
   */
  public function addPermission($permission);

  /**
   * @return iClient
   */
  public function deAuthenticate();
}