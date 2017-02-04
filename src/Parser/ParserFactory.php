<?php

namespace Parser\Parser;

use Parser\Exception\InvalidParserType;

class ParserFactory
{
    const TYPE_PHP = 'php';
    const TYPE_REGEX = 'regex';

    /** @var UrlParserInterface */
    private $parserPhp;

    /** @var UrlParserInterface */
    private $parserRegex;

    /**
     * @param UrlParserInterface $parserPhp
     * @param UrlParserInterface $parserRegex
     */
    public function __construct(UrlParserInterface $parserPhp, UrlParserInterface $parserRegex)
    {
        $this->parserPhp = $parserPhp;
        $this->parserRegex = $parserRegex;
    }

    /**
     * @param $parserType
     * @return UrlParserInterface
     * @throws InvalidParserType
     */
    public function getParser($parserType): UrlParserInterface
    {
        switch ($parserType) {
            case static::TYPE_PHP:
                return $this->parserPhp;
            case static::TYPE_REGEX:
                return $this->parserRegex;
            default:
                throw new InvalidParserType(sprintf('Invalid parser type (%s)', $parserType));
        }
    }
}
