<?php

namespace Parser\Printer;

use Parser\Entity\Url;

interface PrinterInterface
{
    /**
     * @param Url $url
     * @return string
     */
    public function print(Url $url): string;
}
