<?php

namespace Parser\Tests\Unit\Printer;

use Parser\Printer\PrinterFactory;
use Parser\Printer\PrinterInterface;
use PHPUnit\Framework\TestCase;

class PrinterFactoryTest extends TestCase
{
    public function testReturnedType()
    {
        $printerHumanMock = $this->getPrinterMock();
        $printerJsonMock = $this->getPrinterMock();

        $printerFactory = new PrinterFactory($printerHumanMock, $printerJsonMock);

        $this->assertInstanceOf(
            PrinterInterface::class,
            $printerFactory->getPrinter(true)
        );

        $this->assertInstanceOf(
            PrinterInterface::class,
            $printerFactory->getPrinter(false)
        );
    }

    public function testReturnedValue()
    {
        $printerHumanMock = $this->getPrinterMock();
        $printerJsonMock = $this->getPrinterMock();

        $printerFactory = new PrinterFactory($printerHumanMock, $printerJsonMock);

        $this->assertEquals(
            $printerJsonMock,
            $printerFactory->getPrinter(true)
        );

        $this->assertEquals(
            $printerHumanMock,
            $printerFactory->getPrinter(false)
        );
    }

    /**
     * @return PrinterInterface
     */
    private function getPrinterMock(): PrinterInterface
    {
        /** @var \PHPUnit_Framework_MockObject_MockBuilder|PrinterInterface $mock */
        $mock = $this->getMockBuilder(PrinterInterface::class)
            ->setMethods(['print'])
            ->getMock();

        $mock->expects(self::any())
            ->method('print')
            ->willReturn('printing');

        return $mock;
    }
}
