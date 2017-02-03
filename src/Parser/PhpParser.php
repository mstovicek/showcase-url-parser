<?php

namespace Parser\Parser;

use Parser\Entity\Argument;
use Parser\Entity\Url;

class PhpParser implements UrlParserInterface
{
    /**
     * @param string $url
     * @return Url
     */
    public function parse(string $url): Url
    {
        $parsed = parse_url($url);

        return new Url(
            $parsed['scheme'],
            $parsed['host'],
            $parsed['path'],
            $this->parseArguments($parsed['query'])
        );
    }

    /**
     * @param string $query
     * @return Argument[]
     */
    private function parseArguments(string $query): array
    {
        parse_str($query, $output);

        return array_map(
            function ($key, $value) {
                return new Argument($key, $value);
            },
            array_keys($output),
            $output
        );
    }
}
