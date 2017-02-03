<?php

namespace Parser\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class CommandAbstract extends Command
{
    const RETURN_CODE_OK = 0;
    const RETURN_CODE_FAIL = 1;

    /**
     * @param OutputInterface $output
     * @return OutputInterface
     */
    protected static function getErrorOutput(OutputInterface $output) : OutputInterface
    {
        return $output instanceof ConsoleOutputInterface ? $output->getErrorOutput() : $output;
    }
}
