<?php

namespace Albino\Route;

use Albino\Route;
use Albino\iRequest;

/**
 * Regex class.
 *
 * @package    Albino3
 * @subpackage Route
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Regex extends Route
{
  /**
   * @param iRequest $request
   * @return bool
   */
  public function match(iRequest $request)
  {
    $path = $request->getPath();

    if (preg_match($this->getPattern(), $path, $matches) > 0)
    {
      $this->toParams($matches);

      return true;
    }

    return false;
  }

  /**
   * Parses the parameters from the matches
   * and sets them for later retrieval in the
   * action.
   *
   * @param array $matches
   */
  protected function toParams($matches)
  {
    foreach ($matches as $key => $value)
    {
      if (is_numeric($key) === false)
      {
        $this->setParam($key, $value);
      }
    }
  }
}