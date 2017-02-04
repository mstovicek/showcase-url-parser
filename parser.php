<?php

require __DIR__ . '/vendor/autoload.php';

$application = new \Parser\Application();

$application->setDefaultCommand('parse', true);

$application->run();
