<?php

namespace Parser\Tests\Unit\Parser;

use Parser\Parser\PhpParser;

class PhpParserTest extends \PHPUnit_Framework_TestCase
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
}
