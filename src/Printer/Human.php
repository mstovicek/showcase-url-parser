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
                    $this->getSchemeRow($url->getScheme()),
                    $this->getHostRow($url->getHost()),
                    $this->getPathRow($url->getPath()),
                    $this->getArgumentsRows($url->getArguments()),
                ]
            )
        );
    }

    /**
     * @param null|string $scheme
     * @return null|string
     */
    private function getSchemeRow(?string $scheme): ?string
    {
        if ($scheme === null) {
            return null;
        }
        return sprintf('scheme: %s', $scheme);
    }

    /**
     * @param null|string $host
     * @return null|string
     */
    private function getHostRow(?string $host): ?string
    {
        if ($host === null) {
            return null;
        }
        return sprintf('host: %s', $host);
    }

    /**
     * @param null|string $path
     * @return null|string
     */
    private function getPathRow(?string $path): ?string
    {
        if ($path === null) {
            return null;
        }
        return sprintf('path: %s', $path);
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
