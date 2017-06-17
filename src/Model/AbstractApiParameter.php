<?php

namespace Bos\RamlGenerator\Model;

abstract class AbstractApiParameter
{
    const EXAMPLE = 'example';

    /** @var string */
    protected $name;

    /** @var string */
    protected $example;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getExample()
    {
        return $this->example;
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
