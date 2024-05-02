FROM php:8.3-fpm

RUN apt-get update -y && apt-get install

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN pecl install redis-5.3.7
#RUN docker-php-ext-enable redis
RUN pecl install xdebug-3.3.2
RUN docker-php-ext-enable  xdebug

WORKDIR /var/www/project