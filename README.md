# Learning Project

# Setup
1. Copy internal/php/custom.php.ini.dist to internal/php/custom.php.ini
2. Copy .env.local.dist to .env.local
3. Run docker compose up
4. Open http://localhost/ in your browser


# Debug
In Settings -> PHP -> CLI Interpreter, add Docker Server

In Settings -> PHP -> Servers, add localhost with port 80 and absolute path /var/www/project

# PHP Code Sniffer and Beautifier
1. ./vendor/bin/phpcs
2. ./vendor/bin/phpcbf