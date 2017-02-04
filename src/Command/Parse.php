<?php

namespace Parser\Command;

use Parser\Exception\InvalidUrlException;
use Parser\Parser\ParserFactory;
use Parser\Printer\PrinterFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Parse extends CommandAbstract
{
    const NAME = 'parse';

    const ARG_URL = 'url';

    const OPT_JSON = 'json';
    const OPT_PARSER = 'parser';

    /** @var ParserFactory */
    private $parserFactory;

    /** @var PrinterFactory */
    private $printerFactory;

    /**
     * @param ParserFactory $parserFactory
     * @param PrinterFactory $printerFactory
     */
    public function __construct(ParserFactory $parserFactory, PrinterFactory $printerFactory)
    {
        parent::__construct(static::NAME);

        $this->printerFactory = $printerFactory;
        $this->parserFactory = $parserFactory;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setDescription('Parses URL');

        $this->addArgument(static::ARG_URL, InputArgument::REQUIRED, 'URL to be parsed.');

        $this->addOption(static::OPT_JSON, null, InputOption::VALUE_NONE, 'Whether to output json');
        $this->addOption(static::OPT_PARSER, null, InputOption::VALUE_OPTIONAL, 'Parser type to be used: php | regex', 'php');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): ? int
    {
        $isJson = $input->getOption(static::OPT_JSON);
        $parserType = $input->getOption(static::OPT_PARSER);

        $url = $input->getArgument(static::ARG_URL);

        try {
            $urlEntity = $this->parserFactory->getParser($parserType)->parse($url);

            $output->write(
                $this->printerFactory->getPrinter($isJson)->print(
                    $urlEntity
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
}
