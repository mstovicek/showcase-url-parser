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
                    $this->getFieldArray('scheme', $url->getScheme()),
                    $this->getFieldArray('host', $url->getHost()),
                    $this->getFieldArray('path', $url->getPath()),
                    $this->getArgumentsArray($url->getArguments())
                )
            ),
            JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @param string $key
     * @param null|string $value
     * @return array
     */
    private function getFieldArray(string $key, ? string $value) : array
    {
        if ($value === null) {
            return [];
        }

        return [$key => $value];
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
