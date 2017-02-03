<?php
namespace Parser;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setDescription('Parses URL');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('output here');
    }
}
