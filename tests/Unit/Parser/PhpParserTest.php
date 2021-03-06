<?php

namespace Parser\Tests\Unit\Parser;

use Parser\Entity\Url;
use Parser\Parser\PhpParser;

class PhpParserTest extends ParserTestAbstract
{
    /**
     * @expectedException \Parser\Exception\InvalidUrlException
     * @expectedExceptionMessageRegExp /URL \(.+\) is not valid/
     */
    public function testParseInvalidUrl()
    {
        $phpParser = new PhpParser();
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
        $phpParser = new PhpParser();

        $this->assertEquals(
            $expectedUrlEntity,
            $phpParser->parse($url)
        );
    }
}
