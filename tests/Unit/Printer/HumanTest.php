<?php

namespace Parser\Tests\Unit\Printer;

use Parser\Printer\Human;

class HumanTest extends AbstractTestPrinter
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
        $printer = new Human();
        $printedValue = $printer->print($this->getUrlEntity($scheme, $host, $path, $arguments));

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
}
