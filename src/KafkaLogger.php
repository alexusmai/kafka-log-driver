<?php

namespace Alexusmai\KafkaLogDriver;

use Alexusmai\KafkaLogDriver\Handler\KafkaHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use RdKafka\Conf;
use RdKafka\Producer;

class KafkaLogger
{
    /**
     * Create a custom Monolog instance.
     */
    public function __invoke(array $config): Logger
    {
        $producer = new Producer(new Conf());
        $producer->addBrokers(config('kafka_log.brokers'));

        $logger = new Logger('kafka');
        $logger->pushHandler(new KafkaHandler($producer, config('kafka_log.topic')));
        $logger->pushProcessor(new WebProcessor());

        return $logger;
    }
}
