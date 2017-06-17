<?php

namespace Bos\RamlGenerator\Model;

use Bos\RamlGenerator\Helper\Json;

class ApiResponse
{
    /** @var int */
    private $statusCode;

    /** @var string */
    private $content = 'application/json';

    /** @var string */
    private $example;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getExample()
    {
        if (empty($this->example) || !Json::isJson($this->example)) {
            return $this->example;
        }

        return Json::indent($this->example);
    }

    /**
     * @param string $example
     *
     * @return $this
     */
    public function setExample($example)
    {
        $this->example = $example;

        return $this;
    }
}
