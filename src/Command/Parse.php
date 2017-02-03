<?php

namespace Parser\Command;

use Parser\Entity\Argument;
use Parser\Entity\Url;
use Parser\Printer\PrinterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Parse extends Command
{
    const NAME = 'parse';

    const ARG_URL = 'url';

    const OPT_JSON = 'json';

    public function __construct()
    {
        parent::__construct(static::NAME);
    }

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

        $parsed = parse_url($url);

        $urlEntity = new Url(
            $parsed['scheme'],
            $parsed['host'],
            $parsed['path'],
            [
                new Argument('q', 'OLX'),
                new Argument('lang', 'de'),
            ]
        );

        $output->write(
            PrinterFactory::getPrinter($isJson)->print($urlEntity)
        );

        return 0;
    }
}
