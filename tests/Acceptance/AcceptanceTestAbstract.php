<?php

namespace Parser\Tests\Acceptance;

use Parser\Application;
use PHPUnit\Framework\TestCase;

abstract class AcceptanceTestAbstract extends TestCase
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
