<?php

namespace Parser\Printer;

class PrinterFactory
{
    /**
     * @param bool $isJson
     * @return PrinterInterface
     */
    public static function getPrinter(bool $isJson): PrinterInterface
    {
        return $isJson
            ? new Json()
            : new Human();
    }
}
