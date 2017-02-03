<?php

namespace Parser\Command;

use Parser\Parser\UrlParserInterface;
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

    /** @var UrlParserInterface */
    private $urlParser;

    /**
     * @param UrlParserInterface $urlParser
     */
    public function __construct(UrlParserInterface $urlParser)
    {
        parent::__construct(static::NAME);

        $this->urlParser = $urlParser;
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

        $urlEntity = $this->urlParser->parse($url);

        $output->write(
            PrinterFactory::getPrinter($isJson)->print($urlEntity)
        );

        return 0;
    }
}
