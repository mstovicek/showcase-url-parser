<?php

namespace Parser\Tests\Acceptance;

use Symfony\Component\Console\Tester\CommandTester;

class ParseToStringTest extends AcceptanceTest
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
        $returnCode = $commandTester->execute(
            [
                'command'  => $command->getName(),
                'url' => $url,
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
            'google' => [
                'https://www.google.com/?q=OLX&lang=de',
                <<<EOT
scheme: https
host: www.google.com
path: /
arguments:
	q = OLX
	lang = de
EOT
                ,
            ],
        ];
    }
}
