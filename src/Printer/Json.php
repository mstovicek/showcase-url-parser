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
            array_filter(
                array_merge(
                    $this->getSchemeArray($url->getScheme()),
                    $this->getHostArray($url->getHost()),
                    $this->getPathArray($url->getPath()),
                    $this->getArgumentsArray($url->getArguments())
                )
            ),
            JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @param null|string $scheme
     * @return array
     */
    private function getSchemeArray(? string $scheme) : array
    {
        if ($scheme === null) {
            return [];
        }

        return ['scheme' => $scheme];
    }

    /**
     * @param null|string $host
     * @return array
     */
    private function getHostArray(? string $host) : array
    {
        if ($host === null) {
            return [];
        }

        return ['host' => $host];
    }

    /**
     * @param null|string $path
     * @return array
     */
    private function getPathArray(? string $path) : array
    {
        if ($path === null) {
            return [];
        }

        return ['path' => $path];
    }

    /**
     * @param array|null $arguments
     * @return array
     */
    private function getArgumentsArray(? array $arguments) : array
    {
        if ($arguments === null) {
            return [];
        }

        $output = [];
        foreach ($arguments as $argument) {
            $output[$argument->getName()] = $argument->getValue();
        }

        return ['arguments' => $output];
    }
}
