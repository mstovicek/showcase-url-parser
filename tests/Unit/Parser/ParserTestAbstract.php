<?php

namespace Parser\Tests\Unit\Parser;

use Parser\Entity\Argument;
use Parser\Entity\Url;
use PHPUnit\Framework\TestCase;

abstract class ParserTestAbstract extends TestCase
{
    /**
     * @return array
     */
    public function dataProviderTestParse(): array
    {
        return [
            [
                'http://php.net/manual/en/function.parse-url.php',
                new Url(
                    'http',
                    'php.net',
                    '/manual/en/function.parse-url.php',
                    []
                ),
            ],
            [
                'https://bugs.php.net/report.php?bug_type=Documentation+problem&manpage=function.parse-url',
                new Url(
                    'https',
                    'bugs.php.net',
                    '/report.php',
                    [
                        new Argument('bug_type', 'Documentation problem'),
                        new Argument('manpage', 'function.parse-url'),
                    ]
                ),
            ],
            [
                'http://192.168.1.1?user=admin',
                new Url(
                    'http',
                    '192.168.1.1',
                    null,
                    [
                        new Argument('user', 'admin'),
                    ]
                ),
            ],
            [
                'file:///tmp/empty.html',
                new Url(
                    'file',
                    null,
                    '/tmp/empty.html',
                    []
                ),
            ],
        ];
    }
}
