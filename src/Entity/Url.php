<?php

namespace Parser\Entity;

class Url
{
    /** @var string */
    private $scheme;

    /** @var string */
    private $host;

    /** @var string */
    private $path;

    /** @var Argument[] */
    private $arguments;

    /**
     * @param string $scheme
     * @param string $host
     * @param string $path
     * @param Argument[] $arguments
     */
    public function __construct(string $scheme, string $host, string $path, array $arguments)
    {
        $this->scheme = $scheme;
        $this->host = $host;
        $this->path = $path;
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Argument[]
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
