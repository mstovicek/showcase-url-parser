<?php

namespace Parser;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{
    const ARG_URL = 'url';

    const OPT_JSON = 'json';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setDescription('Parses URL');

        $this->addArgument(static::ARG_URL, InputArgument::REQUIRED, 'URL to be parsed.');

        $this->addOption(static::OPT_JSON, null, InputOption::VALUE_OPTIONAL, 'Whether to output json', false);
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): ? int
    {
        $isJson = $input->getOption(static::OPT_JSON);
        $url = $input->getArgument(static::ARG_URL);

        if ($isJson) {
            $output->write(
                json_encode(
                    [$url]
                )
            );
        } else {
            $output->write($url);
        }

        return 0;
    }
}
