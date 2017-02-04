<?php

namespace Parser\Tests\Acceptance;

use Symfony\Component\Console\Tester\CommandTester;

class ParsePartialUrlTest extends AcceptanceTestAbstract
{
    /**
     * @param bool $isJson
     * @param string $url
     * @param string $expectedJsonString
     *
     * @dataProvider dataProviderTestParse
     */
    public function testParse(bool $isJson, string $url, string $expectedJsonString)
    {
        $command = $this->application->find('parse');

        $commandTester = new CommandTester($command);
        $returnCode = $commandTester->execute(
            [
                'command'  => $command->getName(),
                'url' => $url,
                '--json' => $isJson,
            ]
        );

        $this->assertEquals(
            $expectedJsonString,
            $commandTester->getDisplay()
        );

        $this->assertEquals(0, $returnCode);
    }

    /**
     * @return array
     */
    public function dataProviderTestParse(): array
    {
        return [
            'json' => [
                true,
                '/www.google.com/?q=Czechia&lang=de',
                '{"path":"/www.google.com/","arguments":{"q":"Czechia","lang":"de"}}',
            ],
            'human' => [
                false,
                '/www.google.com/?q=Czechia&lang=de',
                <<<EOT
path: /www.google.com/
arguments:
	q = Czechia
	lang = de
EOT
                ,
            ],
            'json without arguments' => [
                true,
                '/www.google.com/',
                '{"path":"/www.google.com/"}',
            ],
            'human without arguments' => [
                false,
                '/www.google.com/',
                <<<EOT
path: /www.google.com/
EOT
                ,
            ],
        ];
    }
}
