<?php

return [
    // topic name
    'topic'         => env('KAFKA_LOG_FILE_TOPIC'),
    // kafka brokers - "10.0.0.1,10.0.0.2"
    'brokers'       => env('KAFKA_LOG_BROKERS'),
    // timeout - ms
    'flush_timeout' => env('KAFKA_LOG_FLUSH_TIMEOUT', 100)
];
