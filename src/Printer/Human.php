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
                    $this->getRow(static::TITLE_SCHEME, $url->getScheme()),
                    $this->getRow(static::TITLE_HOST, $url->getHost()),
                    $this->getRow(static::TITLE_PATH, $url->getPath()),
                    $this->getArgumentsRows(static::TITLE_ARGUMENTS, $url->getArguments()),
                ]
            )
        );
    }

    /**
     * @param string $title
     * @param null|string $value
     * @return null|string
     */
    private function getRow(string $title, ? string $value) : ? string
    {
        if ($value === null) {
            return null;
        }

        return sprintf('%s: %s', $title, $value);
    }

    /**
     * @param string $title
     * @param Argument[]|null $arguments
     * @return null|string
     */
    private function getArgumentsRows(string $title, ? array $arguments) : ? string
    {
        if (empty($arguments)) {
            return null;
        }

        $output = $title . ':';

        foreach ($arguments as $argument) {
            $output .= <<<EOT

	{$argument->getName()} = {$argument->getValue()}
EOT;
        }

        return $output;
    }
}
