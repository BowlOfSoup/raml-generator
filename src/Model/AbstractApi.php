<?php

namespace Bos\RamlGenerator\Model;

abstract class AbstractApi
{
    const DESCRIPTION = 'description';
    const HEADERS = 'headers';
    const QUERY_PARAMETERS = 'queryParameters';
    const RESPONSES = 'responses';
    const BODY = 'body';

    /** @var string */
    protected $description;

    /** @var /** @var \Bos\RamlGenerator\Model\ApiMethod[] */
    protected $methods;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \Bos\RamlGenerator\Model\ApiMethod[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiMethod $method
     *
     * @return $this
     */
    public function addMethod(ApiMethod $method)
    {
        $this->methods[] = $method;

        return $this;
    }
}
