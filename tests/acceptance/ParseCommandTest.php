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

    public function testParse()
    {
        $command = $this->application->find('parse');

        $commandTester = new CommandTester($command);
        $commandTester->execute(
            [
                'command'  => $command->getName()
            ]
        );

        $output = $commandTester->getDisplay();

        $this->assertEquals('output here', $output);
    }
}
