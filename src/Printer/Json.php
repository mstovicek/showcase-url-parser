<?php

namespace Parser\Printer;

use Parser\Entity\Url;

class Json implements PrinterInterface
{
    /**
     * @param Url $url
     * @return string
     */
    public function print(Url $url): string
    {
        return json_encode(
            [
                'scheme' => $url->getScheme(),
                'host' => $url->getHost(),
                'path' => $url->getPath(),
                'arguments' => $this->printArguments($url->getArguments()),
            ],
            JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @param array $arguments
     * @return array
     */
    private function printArguments(array $arguments): array
    {
        $output = [];
        foreach ($arguments as $argument) {
            $output[$argument->getName()] = $argument->getValue();
        }

        return $output;
    }
}
