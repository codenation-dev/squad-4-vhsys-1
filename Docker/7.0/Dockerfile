FROM php:7.0-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    TZ="America/Sao_Paulo"

COPY conf/40-custom.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www

RUN set -e \
    && apk update \
    && apk add --no-cache tzdata \
    && apk add --no-cache icu-dev \
    && apk add --no-cache libzip-dev \
    && apk add --no-cache g++ \
    && apk add --no-cache make \
    && apk add --no-cache autoconf \
    && docker-php-ext-install mysqli pdo_mysql opcache intl zip bcmath \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    #   Clear install
    && pecl clear-cache \
    && composer clear-cache \
    && docker-php-source delete \
    && rm -rf /var/cache/* \
    && rm -Rf /tmp/*
