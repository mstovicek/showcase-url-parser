<?php

namespace Parser\Tests\Unit\Parser;

use Parser\Entity\Url;
use Parser\Parser\ParserFactory;
use Parser\Parser\UrlParserInterface;
use PHPUnit\Framework\TestCase;

class ParserFactoryTest extends TestCase
{
    /**
     * @expectedException \Parser\Exception\InvalidParserType
     * @expectedExceptionMessageRegExp /Invalid parser type \(.+\)/
     */
    public function testGetInvalidPrinterThrowsException()
    {
        $parserFactory = new ParserFactory(
            $this->getParserMock('php'),
            $this->getParserMock('regex')
        );
        $parserFactory->getParser('unknown parser type');
    }

    public function testGetPrinter()
    {
        $parserPhp = $this->getParserMock('php');
        $parserRegex = $this->getParserMock('regex');

        $parserFactory = new ParserFactory(
            $this->getParserMock('php'),
            $this->getParserMock('regex')
        );

        $parser = $parserFactory->getParser(ParserFactory::TYPE_PHP);
        $this->assertInstanceOf(
            UrlParserInterface::class,
            $parser
        );
        $this->assertEquals(
            $parserPhp,
            $parser
        );

        $parser = $parserFactory->getParser(ParserFactory::TYPE_REGEX);
        $this->assertInstanceOf(
            UrlParserInterface::class,
            $parser
        );
        $this->assertEquals(
            $parserRegex,
            $parser
        );
    }

    /**
     * @param string $type
     * @return UrlParserInterface
     */
    private function getParserMock(string $type): UrlParserInterface
    {
        /** @var \PHPUnit_Framework_MockObject_MockBuilder|UrlParserInterface $mock */
        $mock = $this->getMockBuilder(UrlParserInterface::class)
            ->setMethods(['parse'])
            ->getMock();

        $mock->expects(self::any())
            ->method('parse')
            ->willReturn(new Url($type, null, null, null));

        return $mock;
    }
}
