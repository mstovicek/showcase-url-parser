<?php

namespace Parser\Tests\Unit\Parser;

use Parser\Command\CommandAbstract;
use Parser\Command\Parse;
use Parser\Entity\Url;
use Parser\Exception\InvalidUrlException;
use Parser\Parser\UrlParserInterface;
use Parser\Printer\PrinterFactory;
use Parser\Printer\PrinterInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseTest extends TestCase
{
    /**
     * @param bool $parserThrowsException
     * @param int $expectedReturnValue
     *
     * @dataProvider dataProviderTestReturnValue
     */
    public function testReturnValue(bool $parserThrowsException, int $expectedReturnValue)
    {
        $parseCommand = new Parse(
            $this->getUrlParserMock($parserThrowsException),
            $this->getPrinterFactoryMock()
        );
        $returnValue = $parseCommand->run(
            $this->getInputMock(),
            $this->getOutputMock()
        );

        $this->assertEquals(
            $expectedReturnValue,
            $returnValue
        );
    }

    /**
     * @return array
     */
    public function dataProviderTestReturnValue(): array
    {
        return [
            'without exception' => [
                false,
                CommandAbstract::RETURN_CODE_OK,
            ],
            'with exception' => [
                true,
                CommandAbstract::RETURN_CODE_FAIL,
            ],
        ];
    }

    /**
     * @param bool $throwException
     * @return UrlParserInterface
     */
    private function getUrlParserMock(bool $throwException): UrlParserInterface
    {
        /** @var \PHPUnit_Framework_MockObject_MockBuilder|UrlParserInterface $mock */
        $mock = $this->getMockBuilder(UrlParserInterface::class)
            ->setMethods(['parse'])
            ->getMock();

        $mock->method('parse')
            ->will(
                $throwException
                    ? $this->throwException(new InvalidUrlException())
                    : $this->returnValue(new Url(null, null, null, null))
            );

        return $mock;
    }

    /**
     * @return PrinterFactory
     */
    private function getPrinterFactoryMock(): PrinterFactory
    {
        /** @var \PHPUnit_Framework_MockObject_MockBuilder|PrinterInterface $printerMock */
        $printerMock = $this->getMockBuilder(PrinterInterface::class)
            ->setMethods(['print'])
            ->getMock();

        $printerMock->method('print')
            ->willReturn('printing');

        /** @var \PHPUnit_Framework_MockObject_MockBuilder|PrinterFactory $factoryMock */
        $factoryMock = $this->getMockBuilder(PrinterFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPrinter'])
            ->getMock();

        $factoryMock->method('getPrinter')
            ->willReturn($printerMock);

        return $factoryMock;
    }

    /**
     * @return InputInterface
     */
    private function getInputMock(): InputInterface
    {
        /** @var \PHPUnit_Framework_MockObject_MockBuilder|InputInterface $inputMock */
        $inputMock = $this->getMockBuilder(InputInterface::class)
            ->setMethods(
                [
                    'getOption',
                    'getArgument',
                    'getFirstArgument',
                    'hasParameterOption',
                    'getParameterOption',
                    'bind',
                    'validate',
                    'getArguments',
                    'setArgument',
                    'hasArgument',
                    'getOptions',
                    'setOption',
                    'hasOption',
                    'isInteractive',
                    'setInteractive',
                ]
            )
            ->getMock();

        $inputMock->method('getOption')
            ->with($this->equalTo(Parse::OPT_JSON))
            ->willReturn(true);

        $inputMock->method('getArgument')
            ->with($this->equalTo(Parse::ARG_URL))
            ->willReturn('http://google.de');

        return $inputMock;
    }

    /**
     * @return OutputInterface
     */
    private function getOutputMock(): OutputInterface
    {
        /** @var \PHPUnit_Framework_MockObject_MockBuilder|OutputInterface $outputMock */
        $outputMock = $this->getMockBuilder(OutputInterface::class)
            ->setMethods(
                [
                    'write',
                    'writeln',
                    'setVerbosity',
                    'getVerbosity',
                    'isQuiet',
                    'isVerbose',
                    'isVeryVerbose',
                    'isDebug',
                    'setDecorated',
                    'isDecorated',
                    'setFormatter',
                    'getFormatter',
                ]
            )
            ->getMock();

        $outputMock->method('write');

        return $outputMock;
    }
}
