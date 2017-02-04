<?php

namespace Parser\Tests\Unit\Printer;

use Parser\Entity\Argument;
use Parser\Entity\Url;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestPrinter extends TestCase
{
    /**
     * @param null|string $scheme
     * @param null|string $host
     * @param null|string $path
     * @param array|null $arguments
     * @return Url
     */
    protected function getUrlEntity(? string $scheme, ? string $host, ? string $path, ? array $arguments) : Url
    {
        $argumentEntities = [];

        if (!empty($arguments)) {
            foreach ($arguments as $key => $value) {
                $argumentEntities[] = new Argument($key, $value);
            }
        }

        return new Url(
            $scheme,
            $host,
            $path,
            empty($argumentEntities) ? null : $argumentEntities
        );
    }
}
