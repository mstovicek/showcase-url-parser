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
        return implode(
            PHP_EOL,
            array_filter(
                [
                    $this->getRow('scheme', $url->getScheme()),
                    $this->getRow('host', $url->getHost()),
                    $this->getRow('path', $url->getPath()),
                    $this->getArgumentsRows($url->getArguments()),
                ]
            )
        );
    }

    /**
     * @param string $title
     * @param null|string $value
     * @return null|string
     */
    private function getRow(string $title, ?string $value): ?string
    {
        if ($value === null) {
            return null;
        }
        return sprintf('%s: %s', $title, $value);
    }

    /**
     * @param Argument[] $arguments
     * @return string|null
     */
    private function getArgumentsRows($arguments): ?string
    {
        if (empty($arguments)) {
            return null;
        }

        $output = 'arguments:';

        foreach ($arguments as $argument) {
            $output .= <<<EOT

	{$argument->getName()} = {$argument->getValue()}
EOT;
        }

        return $output;
    }
}
