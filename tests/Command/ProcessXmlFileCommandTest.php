<?php 

namespace App\Tests\Command;

use App\Command\ProcessXmlFileCommand;
use PHPUnit\Framework\TestCase;
use App\Service\DBHandlerService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class ProcessXmlFileCommandTest extends TestCase
{
    public function testExecuteSuccess()
    {
        $databaseManagerMock = $this->createMock(DBHandlerService::class);
        $loggerMock = $this->createMock(LoggerInterface::class);

        $command = new ProcessXmlFileCommand($databaseManagerMock, $loggerMock);

        $input = new ArrayInput([]);
        $output = new BufferedOutput();

        $result = $command->run($input, $output);

        $this->assertEquals(0, $result);
    }

    public function testExecuteError()
    {
        $databaseManagerMock = $this->createMock(DBHandlerService::class);
        $databaseManagerMock->method('operateOnProducs')->willThrowException(new \Exception('Error processing operation on inventory: '));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())->method('error')->with('Error processing operation on inventory: ');

        $command = new ProcessXmlFileCommand($databaseManagerMock, $loggerMock);

        $input = new ArrayInput([]);
        $output = new BufferedOutput();

        $result = $command->run($input, $output);

        $this->assertEquals(1, $result);
    }
}