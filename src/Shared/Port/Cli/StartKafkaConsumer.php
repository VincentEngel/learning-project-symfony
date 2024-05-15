<?php

declare(strict_types=1);

namespace App\Shared\Port\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartKafkaConsumer extends Command
{
    private array $kafkaConsumers;

    private const string ARGUEMENT_CONSUMER = 'consumer';

    public function __construct(iterable $kafkaConsumers)
    {
        parent::__construct('app:start-kafka-consumer');

        $this->kafkaConsumers = iterator_to_array($kafkaConsumers);
    }

    protected function configure(): void
    {
        $this->setDescription('Starts the Kafka consumer');
        $this->addArgument(self::ARGUEMENT_CONSUMER, InputArgument::REQUIRED, 'The consumer to start');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting Kafka consumer');

        $consumerName = $input->getArgument(self::ARGUEMENT_CONSUMER);

        $consumer = $this->kafkaConsumers[$consumerName];

        $consumer->__invoke();

        return Command::SUCCESS;
    }
}
