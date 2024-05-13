<?php

declare(strict_types=1);

namespace App\Statistics\Port\Cli;

use App\Statistics\Port\Kafka\LpsPostsConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartKafkaConsumer extends Command
{
    public function __construct(private readonly LpsPostsConsumer $lpsPostsConsumer)
    {
        parent::__construct('app:start-kafka-consumer');
    }

    protected function configure(): void
    {
        $this->setDescription('Starts the Kafka consumer');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting Kafka consumer');
        $this->lpsPostsConsumer->__invoke();
        return Command::SUCCESS;
    }
}
