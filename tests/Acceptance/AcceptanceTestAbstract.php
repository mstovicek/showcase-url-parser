<?php

namespace Parser\Tests\Acceptance;

use Parser\Application;

abstract class AcceptanceTestAbstract extends \PHPUnit_Framework_TestCase
{
    /** @var Application */
    protected $application;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->application = new Application();
    }
}
