<?php

namespace Parser\Parser;

use Parser\Entity\Argument;
use Parser\Entity\Url;
use Parser\Exception\InvalidUrlException;

class RegexParser implements UrlParserInterface
{
    const REGEXP_URL = '$^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?$';
    const REGEXP_ARGUMENTS = '$[\?&]([^&]+)=([^&]+)$';

    const PART_URL_SCHEME = 2;
    const PART_URL_HOST = 4;
    const PART_URL_PATH = 5;
    const PART_URL_ARGUMENTS = 6;

    const PART_ARGUMENT_KEYS = 1;
    const PART_ARGUMENT_VALUES = 2;

    /**
     * @param string $url
     * @return Url
     * @throws InvalidUrlException
     */
    public function parse(string $url): Url
    {
        if (!preg_match(static::REGEXP_URL, $url, $matches)) {
            throw new InvalidUrlException(sprintf('URL (%s) is not valid', $url));
        }

        if (!$matches[static::PART_URL_HOST] && !$matches[static::PART_URL_PATH]) {
            throw new InvalidUrlException(sprintf('URL (%s) is not valid', $url));
        }

        return new Url(
            $this->getSanitizedUrlPart($matches, static::PART_URL_SCHEME),
            $this->getSanitizedUrlPart($matches, static::PART_URL_HOST),
            $this->getSanitizedUrlPart($matches, static::PART_URL_PATH),
            $this->parseArguments(
                $this->getSanitizedUrlPart($matches, static::PART_URL_ARGUMENTS)
            )
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

        preg_match_all(static::REGEXP_ARGUMENTS, $query, $matches);

        return array_map(
            function($key, $value) {
                return new Argument(
                    urldecode($key),
                    urldecode($value)
                );
            },
            $matches[static::PART_ARGUMENT_KEYS],
            $matches[static::PART_ARGUMENT_VALUES]
        );
    }

    /**
     * @param array $matches
     * @param int $part
     * @return null|string
     */
    private function getSanitizedUrlPart(array $matches, int $part): ? string
    {
        if (!isset($matches[$part])) {
            return null;
        }
        return $matches[$part] != '' ? $matches[$part] : null;
    }
}
