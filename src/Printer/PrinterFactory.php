<?php

namespace Parser\Printer;

class PrinterFactory
{
    /** @var PrinterInterface */
    private $humanPrinter;

    /** @var PrinterInterface */
    private $jsonPrinter;

    /**
     * @param PrinterInterface $humanPrinter
     * @param PrinterInterface $jsonPrinter
     */
    public function __construct(PrinterInterface $humanPrinter, PrinterInterface $jsonPrinter)
    {
        $this->humanPrinter = $humanPrinter;
        $this->jsonPrinter = $jsonPrinter;
    }

    /**
     * @param bool $isJson
     * @return PrinterInterface
     */
    public function getPrinter(bool $isJson): PrinterInterface
    {
        return $isJson
            ? $this->jsonPrinter
            : $this->humanPrinter;
    }
}
