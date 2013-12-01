<?php

namespace Lijflied;

use Albino;
use Albino\Route;

/**
 * Router class.
 *
 * @package    Albino3
 * @subpackage Router
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Router extends Albino\Router
{

  /**
   * @see parent
   */
  protected function configure()
  {
    $this->setRoute('homepage', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\Home',
      'pattern' => '/'
    )));

    $this->setRoute('blog_index', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\BlogIndex',
      'pattern' => '/blog'
    )));

    $this->setRoute('contact_index', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\ContactIndex',
      'pattern' => '/contact'
    )));

    $this->setRoute('therapy_index', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\TherapyIndex',
      'pattern' => '/muziektherapie'
    )));

    $this->setRoute('classes_songwriting', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\ClassesSongwriting',
      'pattern' => '/songwritingles'
    )));

    $this->setRoute('classes_singing', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\ClassesSinging',
      'pattern' => '/zangles'
    )));

    $this->setRoute('workshop_index', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\WorkshopIndex',
      'pattern' => '/workshops'
    )));

    $this->setRoute('about_index', new Route\Literal(array(
      'action_class_name' => 'Lijflied\Action\AboutIndex',
      'pattern' => '/over-lijflied'
    )));

    $this->setRoute('blog_detail', new Route\Regex(array(
      'action_class_name' => 'Lijflied\Action\BlogDetail',
      'pattern' => '#/blog/(?P<file>[\w-]+)#'
    )));

    parent::configure();
  }
}