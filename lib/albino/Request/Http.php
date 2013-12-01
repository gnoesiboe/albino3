<?php

namespace Albino\Request;

use Albino;

/**
 * Http class.
 *
 * @package    Albino3
 * @subpackage Request
 * @author     Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @copyright  Freshheads BV
 */
class Http extends Albino\Request implements Albino\Request\iHttp
{

  /**
   * @var string
   */
  const METHOD_GET = 'GET';

  /**
   * @var string
   */
  const METHOD_POST = 'POST';

  /**
   * @var string
   */
  const METHOD_DELETE = 'DELETE';

  /**
   * @var string
   */
  const METHOD_PUT = 'PUT';

  /**
   * @var iHttp
   */
  protected $container;

  /**
   * Constructor
   */
  public function __construct(Albino\Container\Request\iHttp $container)
  {
    $this->container = $container;

    $this->init();
  }

  /**
   * Initiates this request object
   */
  public function init()
  {
    $this->initPath();
    $this->initDomain();
    $this->initHeaders();
    $this->initQuery();
    $this->initMethod();
    $this->initRawBody();
    $this->initBody();
    $this->initFiles();
    $this->initClient();
  }

  /**
   * Initiates the client domain name
   */
  protected function initDomain()
  {
    $this->set('domain', $_SERVER['SERVER_NAME']);
  }

  /**
   * Initiates the client representation
   */
  protected function initClient()
  {
    $client = $this->container->createClientInstance();

    if (($client instanceof Albino\iClient) === false)
    {
      throw new \UnexpectedValueException('Client should implement the iClient interface');
    }

    $this->set('client', $client);
  }

  /**
   * @return Albino\iClient
   */
  public function getClient()
  {
    return $this->doGet('client');
  }

  /**
   * Initiates the easy files access
   */
  protected function initFiles()
  {
    $files = $this->container->createFilesInstance($_FILES);

    if (($files instanceof Albino\iDataHolder) === false)
    {
      throw new \UnexpectedValueException('Files should implement the iDataHolder interface');
    }

    $this->set('files', $files);
  }

  /**
   * @return Albino\DataHolder
   */
  public function getFiles()
  {
    return $this->doGet('files');
  }

  /**
   * Retrieves the raw body and saves it within this object
   */
  protected function initRawBody()
  {
    $this->set('raw_body', trim(file_get_contents('php://input')));
  }

  /**
   * @return string
   */
  public function getRawBody()
  {
    return $this->doGet('raw_body');
  }

  /**
   * Sets the request method used for this request for easy access
   */
  protected function initMethod()
  {
    $this->set('method', strtoupper($_SERVER['REQUEST_METHOD']));
  }

  /**
   * @return string
   */
  public function getMethod()
  {
    return $this->doGet('method');
  }

  /**
   * Inits the request body
   *
   * @throws \UnexpectedValueException
   */
  protected function initBody()
  {
    $body = $this->container->createBodyInstance();

    if (($body instanceof Albino\iDataHolder) === false)
    {
      throw new \UnexpectedValueException('Body should implement the iDataHolder interface');
    }

    /* @var Albino\iDataHolder $body */

    switch ($this->getMethod())
    {
      case self::METHOD_GET:
      case self::METHOD_DELETE:
        // have no request body
        break;

      case self::METHOD_POST:
        $body->setData($_POST);
        break;

      case self::METHOD_PUT:
        $body->setData($this->parsePutVariables());
        break;

      default:
        throw new \UnexpectedValueException(sprintf('Request method: %s not supported', $this->getMethod()));
    }

    $this->set('body', $body);
  }

  /**
   * @return Albino\DataHolder
   */
  public function getBody()
  {
    return $this->doGet('body');
  }

  /**
   * @return bool
   */
  public function isMultipart()
  {
    return stripos($this->getHeaders()->getContentType(), 'multipart/form-data', 0) !== false;
  }

  /**
   * @return string
   */
  public function getMultipartBoundary()
  {
    if ($this->isMultipart() === false)
    {
      return null;
    }

    if (preg_match('#boundary=(?P<key>.*)$#i', $this->getHeaders()->getContentType(), $match) !== false)
    {
      return $match['key'];
    }

    return null;
  }

  /**
   * PHP doesnt support put variables
   *
   * @todo-al optimize and move functionality to seperate methods
   *
   * @return array
   */
  protected function parsePutVariables()
  {
    $putParams = array();
    $input = $this->getRawBody();

    // if not multipart we simply parse the input string and return it as an array
    if ($this->isMultipart() === false)
    {
      parse_str($input, $putParams);
      return $putParams;
    }

    // check if a boundary is used, if not just parse data
    $boundary = $this->getMultipartBoundary();

    if (is_null($boundary) === true)
    {
      parse_str($input, $putParams);
      return $putParams;
    }

    // split by boundary and remove the first item as it is empty
    $values = array_slice(preg_split("/-+$boundary/", $input), 1);

    $lastPartOfInput = "--\r\n";

    foreach ($values as $value)
    {
      // If this is the last part, break
      if (trim($value) === trim($lastPartOfInput))
      {
        break;
      }

      // Separate content from headers
      $value = ltrim($value, "\r\n");
      $valueParts = explode("\r\n\r\n", $value, 2);
      $rawHeaders = count($valueParts) > 1 ? $valueParts[0] : array();
      $content = trim(count($valueParts) > 1 ? $valueParts[1] : $valueParts[0]);
      unset($valueParts);

      // parse raw headers
      $headers = array();
      foreach (explode("\r\n", $rawHeaders) as $header)
      {
        $headerParts = preg_split('#:\s+#', $header);
        if (count($headerParts) < 2)
        {
          continue;
        }

        list($headerKey, $headerValue) = $headerParts;
        $headers[strtolower($headerKey)] = ltrim($headerValue, '');
      }
      unset($rawHeaders);

      // parse content disposition to het the field name etc.
      $contentName = null;
      $contentFileName = null;
      $contentType = null;

      $contentDisposition = isset($headers['content-disposition']) === true ? $headers['content-disposition'] : null;
      if (is_string($contentDisposition) === true)
      {
        if (preg_match('/^(?P<type>[^;]+); *name="(?P<name>[^"]+)"(?:; *filename="(?P<filename>[^"]+)")?/', $contentDisposition, $contentMatches) > 0)
        {
          $contentType = $contentMatches['type'];
          $contentName = $contentMatches['name'];
          $contentFileName = isset($contentMatches['filename']) ? $contentMatches['filename'] : null;
        }
      }

      if (empty($contentName) === true || (empty($contentFileName) === false && empty($contentType) === true))
      {
        // there is not enough data to do something with
        continue;
      }

      $isUploadedFile = is_string($contentFileName) === true;
      if ($isUploadedFile === true)
      {
        $filePath = tempnam(sys_get_temp_dir(), 'albino_');
        file_put_contents($filePath, $content);

        $_FILES[$contentName] = array(
          'name' => $contentFileName,
          'type' => $headers['content-type'],
          'tmp_name' => $filePath,
          'error' => 0,
          'size' => mb_strlen($content)
        );
      }
      else
      {
        $putParams[$contentName] = $content;
      }
    }

    return $putParams;
  }

  /**
   * Retrieves and parses the query string
   */
  protected function initQuery()
  {
    // add query params
    $queryString = substr($_SERVER['REQUEST_URI'], strlen($this->getPath()) + 1);

    $query = $this->container->createQueryInstance(Albino\Util::queryStringToArray($queryString));

    if (($query instanceof Albino\iDataHolder) === false)
    {
      throw new \UnexpectedValueException('Query should implement the iDataHolder interface');
    }

    $this->set('query', $query);
  }

  /**
   * @return Albino\DataHolder
   */
  public function getQuery()
  {
    return $this->doGet('query');
  }

  /**
   * retrieves the request path and
   * saves it to a convenience variable
   */
  protected function initPath()
  {
    $this->set('path', isset($_GET['path']) ? $_GET['path'] : '/');

    unset($_GET['path']);
  }

  /**
   * @return string
   */
  public function getPath()
  {
    return $this->doGet('path');
  }

  /**
   * Gets the headers for this requests and puts them
   * in a data holder for easy access
   */
  protected function initHeaders()
  {
    $headers = $this->container->createHeadersInstance();

    if (($headers instanceof Albino\DataHolder\iRequestHeader) === false)
    {
      throw new \UnexpectedValueException('Headers instance should implement the iRequestHeader interface');
    }

    /* @var Albino\DataHolder\iRequestHeader $headers */

    foreach ($_SERVER as $key => $value)
    {
      if (stripos($key, 'http_', 0) !== false)
      {
        $headers->set($this->prepareHeaderKey($key), $value);
      }
    }

    if ($headers->has('content_type') === false)
    {
      $headers->set('content_type', isset($_SERVER['CONTENT_TYPE']) === true ? $_SERVER['CONTENT_TYPE'] : null);
    }

    $this->set('headers', $headers);
  }

  /**
   * @return Albino\DataHolder\RequestHeader
   */
  public function getHeaders()
  {
    return $this->doGet('headers');
  }

  /**
   * @param string $method
   * @return bool
   */
  public function isMethod($method)
  {
    return $this->getMethod() === $method;
  }

  /**
   * @param string $key
   * @return string
   */
  protected function prepareHeaderKey($key)
  {
    // remove 'http_' prefix
    return strtolower(substr($key, 5));
  }
}
