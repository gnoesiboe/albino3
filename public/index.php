<?php

require_once dirname(__FILE__) . '/../lib/albino/Autoloader.php';

$autoloader = new Albino\Autoloader();
$autoloader
  ->addNamespaces(array(
    'Application' => realpath(dirname(__FILE__) . '/../application'),
    'Lijflied'      => realpath(dirname(__FILE__) . '/../lib/lijflied'),
    'Albino'      => realpath(dirname(__FILE__) . '/../lib/albino')
  ))
  ->register(true)
;

$request = new Albino\Request\Http(new Albino\Container\Request\Http());

$application = new Albino\Application('dev', new Lijflied\Container\Application());

$response = $application->handle($request);
$response->send();