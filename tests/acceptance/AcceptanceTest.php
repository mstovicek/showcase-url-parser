<?php

namespace Parser\Tests\Acceptance;

use Parser\ParserApplication;
use Symfony\Component\Console\Application;

abstract class AcceptanceTest extends \PHPUnit_Framework_TestCase
{
    /** @var Application */
    protected $application;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->application = new ParserApplication();
    }
}
