FROM nginx



FROM php:7.3-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    TZ="America/Sao_Paulo"

#COPY ../7.3/conf/40-custom.ini /usr/local/etc/php/conf.d/40-custom.ini

RUN set -e \
    && apk update \
    && apk add --no-cache tzdata \
    && apk add --no-cache icu-dev \
    && apk add --no-cache libzip-dev \
    && apk add --no-cache g++ \
    && apk add --no-cache make \
    && apk add --no-cache autoconf \
#    Dependencias webgrind
    && apk add --no-cache python3 \
    && apk add --no-cache graphviz \
    && if [ ! -e /usr/bin/python ]; then ln -sf python3 /usr/bin/python ; fi \
    && docker-php-ext-install \
        mysqli \
        pdo_mysql \
        opcache \
        intl \
        zip \
        bcmath \
    && pecl install \
        xdebug \
        redis \
    && docker-php-ext-enable \
        xdebug \
        redis \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require hirak/prestissimo --no-plugins --no-scripts \
#   Clear install
    && pecl clear-cache \
    && composer clear-cache \
    && docker-php-source delete \
    && rm -rf /var/cache/* \
    && rm -Rf /tmp/*

RUN sed -e 's/;pm.status_path = \/status/pm.status_path = \/status/' -i /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www
