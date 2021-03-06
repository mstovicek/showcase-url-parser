<?php

namespace Parser\Tests\Acceptance;

use Symfony\Component\Console\Tester\CommandTester;

class ParseToJsonTest extends AcceptanceTestAbstract
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
                'https://www.google.com/?q=Czechia&lang=de',
                '{"scheme":"https","host":"www.google.com","path":"/","arguments":{"q":"Czechia","lang":"de"}}',
            ],
            'human' => [
                false,
                'https://www.google.com/?q=Czechia&lang=de',
                <<<EOT
scheme: https
host: www.google.com
path: /
arguments:
	q = Czechia
	lang = de
EOT
                ,
            ],
            'json with space' => [
                true,
                'https://www.google.com/?q=C+Z+E+C+H+I+A&lang=de',
                '{"scheme":"https","host":"www.google.com","path":"/","arguments":{"q":"C Z E C H I A","lang":"de"}}',
            ],
        ];
    }
}
