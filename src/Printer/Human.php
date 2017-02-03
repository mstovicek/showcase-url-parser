<?php

namespace Parser\Printer;

use Parser\Entity\Argument;
use Parser\Entity\Url;

class Human implements PrinterInterface
{
    /**
     * @param Url $url
     * @return string
     */
    public function print(Url $url): string
    {
        return <<<EOT
scheme: {$url->getScheme()}
host: {$url->getHost()}
path: {$url->getPath()}
arguments:{$this->printArguments($url->getArguments())}
EOT;
    }

    /**
     * @param Argument[] $arguments
     * @return string
     */
    private function printArguments($arguments): string
    {
        $output = '';

        foreach ($arguments as $argument) {
            $output .= <<<EOT

	{$argument->getName()} = {$argument->getValue()}
EOT;
        }

        return $output;
    }
}
