<?php

namespace Bos\RamlGenerator\Model;

use Bos\RamlGenerator\Helper\Json;

class ApiMethod extends AbstractApi
{
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';

    /** @var string */
    private $methodName;

    /** @var \Bos\RamlGenerator\Model\ApiHeader[] */
    private $headers = array();

    /** @var \Bos\RamlGenerator\Model\ApiQueryParameter[] */
    private $queryParameters = array();

    /** @var \Bos\RamlGenerator\Model\ApiResponse[] */
    private $responses = array();

    /** @var string */
    private $body;

    /** @var array */
    private $knownMethods = array('get', 'post', 'put', 'delete');

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @param string $methodName
     *
     * @return $this
     */
    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;

        return $this;
    }

    /**
     * @return \Bos\RamlGenerator\Model\ApiHeader[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiHeader $headers
     *
     * @return $this
     */
    public function addHeader(ApiHeader $headers)
    {
        $this->headers[] = $headers;

        return $this;
    }

    /**
     * @return \Bos\RamlGenerator\Model\ApiQueryParameter[]
     */
    public function getQueryParameters()
    {
        return $this->queryParameters;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiQueryParameter $queryParameters
     *
     * @return $this
     */
    public function addQueryParameter(ApiQueryParameter $queryParameters)
    {
        $this->queryParameters[] = $queryParameters;

        return $this;
    }

    /**
     * @return \Bos\RamlGenerator\Model\ApiResponse[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiResponse $responses
     *
     * @return $this
     */
    public function addResponse(ApiResponse $responses)
    {
        $this->responses[] = $responses;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        if (empty($this->body) || !Json::isJson($this->body)) {
            return $this->body;
        }

        return Json::indent($this->body);
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isKnownMethod($method)
    {
        return in_array($method, $this->knownMethods);
    }
}
