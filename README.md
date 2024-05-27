# Learning Project

# Setup
1. Copy internal/php/custom.php.ini.dist to internal/php/custom.php.ini
2. Copy .env.local.dist to .env.local
3. Run docker compose up
4. Open http://localhost/ in your browser


# Debug
In Settings -> PHP -> CLI Interpreter, add Docker Server

In Settings -> PHP -> Servers, add localhost with port 80 and absolute path /var/www/project use name=phpproject

In order to debug tests and cli commands prefix your request with XDEBUG_TRIGGER=yes

e.g. XDEBUG_TRIGGER=yes php bin/phpunit

# SSH
`task ssh`

# PHP CS Fixer
https://github.com/PHP-CS-Fixer/PHP-CS-Fixer

`task phpcs`

# Psalm
https://github.com/vimeo/psalm/

`task psalm`

# PHP Unit
https://github.com/sebastianbergmann/phpunit/

1. APP_ENV=test vendor/bin/phpunit --testdox tests/Unit
2. APP_ENV=test vendor/bin/phpunit --testdox tests/Integration

# Kafka
Create a topic
1. docker compose exec -it kafka bash
2. /opt/bitnami/kafka/bin/kafka-topics.sh --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 1 --topic test

# Google Protobuf
protoc --php_out=gprotobuf src/Shared/Port/Gprotobuf/post.proto

# RabbitMQ
http://localhost:15672/
guest:guest

# Consume async commands
php bin/console messenger:consume async_commands --queues=command.post.export -vv