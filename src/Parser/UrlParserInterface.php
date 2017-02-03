<?php

namespace Parser\Parser;

use Parser\Entity\Url;

interface UrlParserInterface
{
    /**
     * @param string $url
     * @return Url
     */
    public function parse(string $url): Url;
}
