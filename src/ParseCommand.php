<?php
namespace Parser;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{
    protected function configure()
    {
        $this->setDescription('Parses URL');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
