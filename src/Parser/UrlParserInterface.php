<?php

namespace Parser\Parser;

use Parser\Entity\Url;
use Parser\Exception\InvalidUrlException;

interface UrlParserInterface
{
    /**
     * @param string $url
     * @return Url
     * @throws InvalidUrlException
     */
    public function parse(string $url): Url;
}
