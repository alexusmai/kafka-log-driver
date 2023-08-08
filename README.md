# Laravel log driver for Kafka

## Requirements:

- PHP 8.1
- Laravel 9
- rdkafka php extension v.6

```bash
sudo pecl install rdkafka
```

Add the following line to your php.ini file:

```
extension=rdkafka.so
```

## Installation

You can install the package via composer:

```bash
composer require alexusmai/kafka-log-driver
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="kafka-log-driver-config"
```

This is the contents of the published config file (kafka_log.php):

```php
return [
    // topic name
    'topic'         => env('KAFKA_LOG_FILE_TOPIC'),
    // kafka brokers - "10.0.0.1,10.0.0.2"
    'brokers'       => env('KAFKA_LOG_BROKERS'),
    // timeout - ms
    'flush_timeout' => env('KAFKA_LOG_FLUSH_TIMEOUT', 100)
];
```

## Usage

Add to `.env`

```
KAFKA_LOG_FILE_TOPIC=
KAFKA_LOG_BROKERS=
// if you want to change the default value (100 ms)
KAFKA_LOG_FLUSH_TIMEOUT=
```

Add to `config/logging.php`

```php
'channels' => [
    ...
    'kafka' => [
        'driver' => 'custom',
        'via' => Alexusmai\KafkaLogDriver\KafkaLogger::class,
    ],
    ...
],
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
