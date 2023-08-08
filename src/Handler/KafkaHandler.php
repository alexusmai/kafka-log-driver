<?php

namespace Alexusmai\KafkaLogDriver\Handler;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\LogRecord;
use RdKafka\Producer;
use RdKafka\ProducerTopic;

class KafkaHandler extends AbstractProcessingHandler
{
    private Producer $producer;
    private ProducerTopic $topic;

    /**
     * @param  Producer  $producer
     * @param $topicName
     * @param $level
     * @param  bool  $bubble
     */
    public function __construct(Producer $producer, $topicName, $level = Level::Debug, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->producer = $producer;
        $this->topic = $producer->newTopic($topicName);
    }

    /**
     * @param  LogRecord  $record
     *
     * @return void
     */
    protected function write(LogRecord $record): void
    {
        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, $record['formatted']);
    }

    /**
     * @return FormatterInterface
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LineFormatter('[%datetime%] %channel%.%level_name%: %message% %context% %extra%');
    }

    /**
     * https://github.com/arnaud-lb/php-rdkafka#proper-shutdown
     *
     * @return void
     */
    public function close(): void
    {
        $this->producer->flush(config('kafka_log.flush_timeout'));
    }
}
