<?php
namespace Parser;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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

        $this->addArgument('url', InputArgument::REQUIRED, 'URL to be parsed.');

    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $output->write(
            json_encode(
                []
            )
        );

        return 0;
    }
}
