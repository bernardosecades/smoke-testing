FROM php:7.1-fpm


RUN apt-get update \
    && apt-get -y install zlib1g-dev zip unzip git vim ant wget \
    && docker-php-ext-install json \
    && docker-php-ext-install zip \
    && pecl install apcu-5.1.5 \
    && docker-php-ext-enable apcu \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
ADD install-composer.sh /tmp
RUN chmod +x /tmp/install-composer.sh
RUN  /tmp/install-composer.sh \
    && rm -rf /tmp/pear \
    && useradd smoke-testing

USER smoke-testing
