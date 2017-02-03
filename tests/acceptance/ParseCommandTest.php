<?php
namespace Parser\Tests\Acceptance;

use Parser\ParseCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var Application */
    private $application;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->application = new Application();
        $this->application->add(new ParseCommand('parse'));
    }

    /**
     * @param string $url
     * @param array $expectedJsonAsArray
     *
     * @dataProvider dataProviderTestParse
     */
    public function testParse(string $url, array $expectedJsonAsArray)
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
            $expectedJsonAsArray,
            json_decode(
                $commandTester->getDisplay()
            )
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
                [
                    'scheme' => 'https',
                    'host' => 'www.google.com',
                    'path' => '/',
                    'arguments' => [
                        'q' => 'OLX',
                        'lang' => 'de'
                    ]
                ]
            ]
        ];
    }
}
