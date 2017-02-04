<?php

namespace Parser\Printer;

use Parser\Entity\Url;

interface PrinterInterface
{
    const TITLE_SCHEME = 'scheme';
    const TITLE_HOST = 'host';
    const TITLE_PATH = 'path';
    const TITLE_ARGUMENTS = 'arguments';

    /**
     * @param Url $url
     * @return string
     */
    public function print(Url $url): string;
}
