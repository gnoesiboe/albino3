<?php

namespace Albino\View;

use Albino\View;

/**
 * Template class.
 *
 * @package    Albino3
 * @subpackage View
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 *
 * @method Template setData(array $data, $merge = false)
 * @method Template set($key, $value)
 */
class Template extends View
{

  /**
   * @var string
   */
  protected $templatePath = null;

  /**
   * @var string
   */
  protected $layoutPath = null;

  /**
   * @var bool
   */
  protected $useLayout = true;

  /**
   * @param string $path
   * @return Template
   */
  public function setTemplatePath($path)
  {
    $this->templatePath = $path;

    return $this;
  }

  /**
   * @param bool $use
   * @return Template
   */
  public function useLayout($use)
  {
    $this->useLayout = $use;

    return $this;
  }

  /**
   * @param string $path
   */
  public function setLayoutPath($path)
  {
    $this->layoutPath = $path;
  }

  /**
   * @return string
   */
  public function render()
  {
    $this->validateTemplatePathSet();

    $content = $this->renderView($this->templatePath, $this->values);

    if ($this->useLayout === true && $this->hasLayoutPathSet() === true)
    {
      // $content is used in layout template

      $content = $this->renderView($this->layoutPath, array(
        'content' => $content
      ));
    }

    return $content;
  }

  /**
   * @param string $path
   * @param array $params
   *
   * @return string
   */
  public function renderView($path, array $params = array())
  {
    extract($params);

    ob_start();
    require $path;
    return ob_get_clean();
  }

  /**
   * @return bool
   */
  protected function hasLayoutPathSet()
  {
    return is_string($this->layoutPath) === true;
  }

  /**
   * @throws \UnexpectedValueException
   */
  protected function validateTemplatePathSet()
  {
    if ($this->hasTemplatePathSet() === false)
    {
      throw new \UnexpectedValueException('No template path set for view');
    }
  }

  /**
   * @return bool
   */
  protected function hasTemplatePathSet()
  {
    return is_string($this->templatePath) === true;
  }
}
