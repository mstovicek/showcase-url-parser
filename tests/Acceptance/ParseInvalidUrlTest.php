<?php

namespace Parser\Tests\Acceptance;

use Symfony\Component\Console\Tester\CommandTester;

class ParseInvalidUrlTest extends AcceptanceTestAbstract
{
    /**
     * @param bool $isJson
     * @param string $url
     *
     * @dataProvider dataProviderTestParse
     */
    public function testParse(bool $isJson, string $url)
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
            sprintf('URL (%s) is not valid', $url),
            $commandTester->getDisplay()
        );

        $this->assertEquals(1, $returnCode);
    }

    /**
     * @return array
     */
    public function dataProviderTestParse(): array
    {
        return [
            'json' => [
                true,
                'http://?',
            ],
            'human' => [
                false,
                'http://?',
            ],
        ];
    }
}
