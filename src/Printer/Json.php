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
                    $this->getFieldArray(static::TITLE_SCHEME, $url->getScheme()),
                    $this->getFieldArray(static::TITLE_HOST, $url->getHost()),
                    $this->getFieldArray(static::TITLE_PATH, $url->getPath()),
                    $this->getArgumentsArray(static::TITLE_ARGUMENTS, $url->getArguments())
                )
            ),
            JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT
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
     * @param string $key
     * @param array|null $arguments
     * @return array
     */
    private function getArgumentsArray(string $key, ? array $arguments) : array
    {
        if ($arguments === null) {
            return [];
        }

        $output = [];
        foreach ($arguments as $argument) {
            $output[$argument->getName()] = $argument->getValue();
        }

        return [$key => $output];
    }
}
