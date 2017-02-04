<?php

namespace Parser\Tests\Unit\Parser;

use Parser\Entity\Url;
use Parser\Parser\RegexParser;

class RegexParserTest extends ParserTestAbstract
{
    /**
     * @expectedException \Parser\Exception\InvalidUrlException
     * @expectedExceptionMessageRegExp /URL \(.+\) is not valid/
     */
    public function testParseInvalidUrl()
    {
        $phpParser = new RegexParser();
        $phpParser->parse('http://');
    }

    /**
     * @param string $url
     * @param Url $expectedUrlEntity
     *
     * @dataProvider dataProviderTestParse
     */
    public function testParse(string $url, Url $expectedUrlEntity)
    {
        $phpParser = new RegexParser();

        $this->assertEquals(
            $expectedUrlEntity,
            $phpParser->parse($url)
        );
    }
}
