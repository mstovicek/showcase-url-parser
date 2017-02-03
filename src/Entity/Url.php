<?php

namespace Parser\Entity;

class Url
{
    /** @var string|null */
    private $scheme;

    /** @var string|null */
    private $host;

    /** @var string|null */
    private $path;

    /** @var Argument[]|null */
    private $arguments;

    /**
     * @param string|null $scheme
     * @param string|null $host
     * @param string|null $path
     * @param Argument[]|null $arguments
     */
    public function __construct(? string $scheme, ? string $host, ? string $path, ? array $arguments)
    {
        $this->scheme = $scheme;
        $this->host = $host;
        $this->path = $path;
        $this->arguments = $arguments;
    }

    /**
     * @return string|null
     */
    public function getScheme() : ? string
    {
        return $this->scheme;
    }

    /**
     * @return string|null
     */
    public function getHost() : ? string
    {
        return $this->host;
    }

    /**
     * @return string|null
     */
    public function getPath() : ? string
    {
        return $this->path;
    }

    /**
     * @return Argument[]|null
     */
    public function getArguments() : ? array
    {
        return $this->arguments;
    }
}
