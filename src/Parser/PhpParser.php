<?php

namespace Parser\Parser;

use Parser\Entity\Argument;
use Parser\Entity\Url;
use Parser\Exception\InvalidUrlException;

class PhpParser implements UrlParserInterface
{
    /**
     * @param string $url
     * @return Url
     * @throws InvalidUrlException
     */
    public function parse(string $url): Url
    {
        $parsed = parse_url($url);

        if ($parsed === false) {
            throw new InvalidUrlException(sprintf('URL (%s) is not valid', $url));
        }

        return new Url(
            $parsed['scheme'] ?? null,
            $parsed['host'] ?? null,
            $parsed['path'] ?? null,
            $this->parseArguments($parsed['query'] ?? null)
        );
    }

    /**
     * @param string|null $query
     * @return Argument[]
     */
    private function parseArguments(? string $query) : array
    {
        if ($query === null) {
            return [];
        }

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
