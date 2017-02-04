<?php

namespace Parser\Tests\Unit\Printer;

use Parser\Entity\Argument;
use Parser\Entity\Url;
use Parser\Printer\Json;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    /**
     * @param null|string $scheme
     * @param null|string $host
     * @param null|string $path
     * @param array|null $arguments
     * @param string $expected
     *
     * @dataProvider dataProviderTestPrint
     */
    public function testPrint(? string $scheme, ? string $host, ? string $path, ? array $arguments, string $expected)
    {
        $printer = new Json();
        $printedValue = $printer->print($this->getUrlEntity($scheme, $host, $path, $arguments));

        $this->assertJson($printedValue);

        $this->assertEquals(
            $expected,
            $printedValue
        );
    }

    /**
     * @return array
     */
    public function dataProviderTestPrint() : array
    {
        return [
            [
                'scheme',
                'host',
                'path',
                [
                    'arg' => 'u m e n t',
                ],
                '{"scheme":"scheme","host":"host","path":"path","arguments":{"arg":"u m e n t"}}',
            ],
            [
                null,
                null,
                null,
                null,
                '{}',
            ],
            [
                '',
                '',
                '',
                [],
                '{}',
            ],
            [
                'scheme',
                '',
                'path',
                [
                    'a' => 'A',
                    'b' => 'B',
                    'c' => 'C',
                ],
                '{"scheme":"scheme","path":"path","arguments":{"a":"A","b":"B","c":"C"}}',
            ],
        ];
    }

    /**
     * @param null|string $scheme
     * @param null|string $host
     * @param null|string $path
     * @param array|null $arguments
     * @return Url
     */
    private function getUrlEntity(? string $scheme, ? string $host, ? string $path, ? array $arguments) : Url
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
