<?php

namespace Albino;

/**
 * Response class.
 *
 * @package    Albino
 * @subpackage Response
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Response extends DataHolder implements iResponse
{

  /**
   * @var string
   */
  const DEFAULT_PROTOCOL = 'HTTP/1.1';

  /**
   * @var int
   */
  const DEFAULT_STATUS_CODE = 200;

  /**
   * @var string
   */
  const DEFAULT_STATUS_TEXT = 'ok';

  /**
   * @var array
   */
  protected $statusCodes = array(
    100 => 'CONTINUE',
    101 => 'SWITCHING PROTOCOLS',
    200 => 'OK',
    201 => 'CREATED',
    202 => 'ACCEPTED',
    203 => 'NON-AUTHORITATIVE INFORMATION',
    204 => 'NO CONTENT',
    205 => 'RESET CONTENT',
    206 => 'PARTIAL CONTENT',
    300 => 'MULTIPLE CHOICES',
    301 => 'MOVED PERMANENTLY',
    302 => 'FOUND',
    303 => 'SEE OTHER',
    304 => 'NOT MODIFIED',
    305 => 'USE PROXY',
    306 => '(UNUSED)',
    307 => 'TEMPORARY REDIRECT',
    400 => 'BAD REQUEST',
    401 => 'UNAUTHORIZED',
    402 => 'PAYMENT REQUIRED',
    403 => 'FORBIDDEN',
    404 => 'NOT FOUND',
    405 => 'METHOD NOT ALLOWED',
    406 => 'NOT ACCEPTABLE',
    407 => 'PROXY AUTHENTICATION REQUIRED',
    408 => 'REQUEST TIMEOUT',
    409 => 'CONFLICT',
    410 => 'GONE',
    411 => 'LENGTH REQUIRED',
    412 => 'PRECONDITION FAILED',
    413 => 'REQUEST ENTITY TOO LARGE',
    414 => 'REQUEST-URI TOO LONG',
    415 => 'UNSUPPORTED MEDIA TYPE',
    416 => 'REQUESTED RANGE NOT SATISFIABLE',
    417 => 'EXPECTATION FAILED',
    500 => 'INTERNAL SERVER ERROR',
    501 => 'NOT IMPLEMENTED',
    502 => 'BAD GATEWAY',
    503 => 'SERVICE UNAVAILABLE',
    504 => 'GATEWAY TIMEOUT',
    505 => 'HTTP VERSION NOT SUPPORTED',
  );

  /**
   * @param string $content
   * @param int $statusCode
   * @param string $statusText
   */
  public function __construct($content = null, $statusCode = null, $statusText = null)
  {
    parent::__construct($this->getDefaults());

    if (is_null($content) === false)
    {
      $this->setContent($content);
    }

    if (is_null($statusCode) === false)
    {
      $this->setStatusCode($statusCode);
    }

    if (is_null($statusText) === false)
    {
      $this->setStatusText($statusText);
    }
  }

  /**
   * @param int $code
   * @return string
   */
  public function getStatusTextByCode($code)
  {
    $this->validateStatusCodeSupported($code);

    return $this->statusCodes[(int) $code];
  }

  /**
   * @param int $code
   * @throws \UnexpectedValueException
   */
  protected function validateStatusCodeSupported($code)
  {
    if ($this->checkStatusCodeSupported($code) === false)
    {
      throw new \UnexpectedValueException(sprintf('Status code: %s not supported', $code));
    }
  }

  /**
   * @param int $code
   * @return bool
   */
  public function checkStatusCodeSupported($code)
  {
    return array_key_exists((int) $code, $this->statusCodes);
  }

  /**
   * @param int $code
   * @return Response
   */
  public function setStatusCode($code)
  {
    $this->set('statusCode', (int) $code);

    if ($this->hasStatusTextForCode($code) === true)
    {
      $this->setStatusText($this->getStatusTextForCode($code));
    }

    return $this;
  }

  /**
   * @param int $code
   * @return bool
   */
  public function hasStatusTextForCode($code)
  {
    return array_key_exists($code, $this->statusCodes);
  }

  /**
   * @param int $code
   * @param mixed $default
   *
   * @return string
   */
  public function getStatusTextForCode($code, $default = null)
  {
    return $this->hasStatusTextForCode($code) === true ? $this->statusCodes[$code] : $default;
  }

  /**
   * @param string $text
   * @return Response
   */
  public function setStatusText($text)
  {
    $this->set('statusText', strtoupper($text));

    return $this;
  }

  /**
   * @param string $key
   * @param string $value
   *
   * @return Response
   */
  public function setHeader($key, $value)
  {
    $this->get('headers')->set($key, $value);

    return $this;
  }

  /**
   * @return DataHolder
   */
  public function getHeaders()
  {
    return $this->doGet('headers');
  }

  /**
   * @param string $content
   * @return Response
   */
  public function setContent($content)
  {
    $this->set('content', $content);

    return $this;
  }

  /**
   * @return array
   */
  protected function getDefaults()
  {
    return array(
      'headers'    => $this->getDefaultHeaders(),
      'protocol'   => self::DEFAULT_PROTOCOL,
      'statusCode' => self::DEFAULT_STATUS_CODE,
      'statusText' => self::DEFAULT_STATUS_TEXT,
      'content'    => ''
    );
  }

  /**
   * @return array
   */
  protected function getDefaultHeaders()
  {
    return new DataHolder(array(
      'Content-Type' => 'text/html; charset=utf-8'
    ));
  }

  /**
   * Sends the response back to the client
   */
  public function send()
  {
    $this->sendHeaders();
    $this->sendContent();

    exit(0);
  }

  /**
   * Sends the headers to the client
   */
  protected function sendHeaders()
  {
    header($this->generateStatusHeader());

    foreach ($this->getHeaders() as $name => $value)
    {
      header($name . ': ' . $value);
    }
  }

  /**
   * Sends the response body to the client
   */
  protected function sendContent()
  {
    echo $this->get('content');
  }

  /**
   * @return string
   */
  protected function generateStatusHeader()
  {
    return $this->get('protocol') . ' ' . $this->get('statusCode') . ' ' . $this->get('statusText');
  }
}