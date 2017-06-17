<?php

namespace Bos\RamlGenerator\Model;

class Definition
{
    const TITLE = 'title';
    const BASE_URI = 'baseUri';
    const VERSION = 'version';
    const MEDIA_TYPE = 'mediaType';

    /** @var string */
    private $ramlVersion = '1.0';

    /** @var string */
    private $title;

    /** @var string */
    private $baseUri;

    /** @var int */
    private $version = 1;

    /** @var string */
    private $mediaType = 'application/json';

    /**
     * @return string
     */
    public function getRamlVersion()
    {
        return $this->ramlVersion;
    }

    /**
     * @param string $ramlVersion
     *
     * @return $this
     */
    public function setRamlVersion($ramlVersion)
    {
        $this->ramlVersion = $ramlVersion;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     *
     * @return $this
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     *
     * @return $this
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;

        return $this;
    }
}
