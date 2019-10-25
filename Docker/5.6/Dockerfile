FROM php:5.6-fpm

COPY conf/40-custom.ini /usr/local/etc/php/conf.d/40-custom.ini

RUN set -e \
    && apt-get update \
    && apt-get install -my wget zlib1g-dev libicu-dev g++ libxml2-dev git zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        mysql \
        pdo_mysql \
        intl \
        soap \
        mysqli \
        bcmath \
    && pecl install xdebug-2.5.0 timezonedb \
    && docker-php-ext-enable xdebug timezonedb

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer
