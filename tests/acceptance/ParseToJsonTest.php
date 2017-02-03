<?php

namespace Parser\Tests\Acceptance;

use Symfony\Component\Console\Tester\CommandTester;

class ParseToJsonTest extends AcceptanceTest
{
    /**
     * @param string $url
     * @param string $expectedJsonString
     *
     * @dataProvider dataProviderTestParse
     */
    public function testParse(string $url, string $expectedJsonString)
    {
        $command = $this->application->find('parse');

        $commandTester = new CommandTester($command);
        $commandTester->execute(
            [
                'command'  => $command->getName(),
                'url' => $url,
                '--json' => true,
            ]
        );

        $this->assertEquals(
            $expectedJsonString,
            $commandTester->getDisplay()
        );
    }

    /**
     * @return array
     */
    public function dataProviderTestParse(): array
    {
        return [
            'google' => [
                'https://www.google.com/?q=OLX&lang=de',
                '{"scheme":"https","host":"www.google.com","path":"/","arguments":{"q":"OLX","lang":"de"}}',
            ],
        ];
    }
}
