<?php

namespace Parser\Command;

use Parser\Exception\InvalidUrlException;
use Parser\Parser\UrlParserInterface;
use Parser\Printer\PrinterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Parse extends Command
{
    const NAME = 'parse';

    const ARG_URL = 'url';

    const OPT_JSON = 'json';

    const RETURN_CODE_OK = 0;
    const RETURN_CODE_FAIL = 1;

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

        try {
            $output->write(
                PrinterFactory::getPrinter($isJson)->print(
                    $this->urlParser->parse($url)
                )
            );

            return static::RETURN_CODE_OK;
        } catch (InvalidUrlException $e) {
            static::getErrorOutput($output)->write($e->getMessage());

            return static::RETURN_CODE_FAIL;
        } catch (\Exception $e) {
            static::getErrorOutput($output)->write('Unexpected exception: ' . $e->getMessage());

            return static::RETURN_CODE_FAIL;
        }
    }

    /**
     * @param OutputInterface $output
     * @return OutputInterface
     */
    private static function getErrorOutput(OutputInterface $output) : OutputInterface
    {
        return $output instanceof ConsoleOutputInterface ? $output->getErrorOutput() : $output;
    }
}
