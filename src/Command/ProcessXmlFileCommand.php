<?php 

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\DBHandlerService;
use Psr\Log\LoggerInterface;

class ProcessXmlFileCommand extends Command
{
    /**
     * defaultName (command to be execute)
     *
     * @var string
     */
    protected static $defaultName = 'app:xml-import';

    /**
     * ProcessXmlCommand constructor.
     * @param DBHandlerService  $DBHandlerService
     * @param LoggerInterface  $logger
     * @param string           $projectDir
     */
    public function __construct(private DBHandlerService $DBHandlerService, private LoggerInterface $logger)
    {
        parent::__construct();
    }

    /**
     * Configures the command.
     */
    protected function configure()
    {
        $this
            ->setDescription('Parse XML and update database')
            ->setHelp('The command process XML to import product in the database.');
    }

   /**
     * Executes the command to process XML data.
     *
     * @param InputInterface  $input  input interface providing command input.
     * @param OutputInterface $output output interface for displaying command output.
     *
     * @return int The result code returning the success or failure of the command execution.
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Processing XML file...');

        $xmlFilePath = './public/feed.xml';

        try {
            $xml = simplexml_load_file($xmlFilePath);

            $this->DBHandlerService->operateOnProducs($xml);

            $output->writeln('XML file successfully procesed.');
        } catch (\Exception $e) {

            $this->logger->error('Error processing operation on inventory: ', []);

            $output->writeln('Error while importing XML: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}