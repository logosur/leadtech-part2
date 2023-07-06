FROM php:8.2-fpm

RUN apt-get update -y && apt-get install procps -y --force-yes 
RUN apt-get install -y \
            git \
            libzip-dev \
            libc-client-dev \
            libkrb5-dev \
            libpng-dev \
            libjpeg-dev \
            libwebp-dev \
            libfreetype6-dev \
            libkrb5-dev \
            libicu-dev \
            zlib1g-dev \
            zip \
            ffmpeg \
            libmemcached11 \
            libmemcachedutil2 \
            build-essential \
            libmemcached-dev \
            gnupg2 \
            libpq-dev \
            libpq5 \
            libz-dev

RUN docker-php-ext-install gd
RUN apt-get install dnsutils -y
RUN apt-get install joe -y
RUN apt-get install wget -y
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN docker-php-ext-install pdo pdo_mysql mysqli pgsql pdo_pgsql

RUN apt remove cmdtest -y
RUN apt remove yarn -y
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update -y
RUN apt-get install yarn -y
RUN docker-php-ext-install mysqli
RUN apt install iputils-ping -y
RUN apt install net-tools -y
RUN apt-get install telnet -y

EXPOSE 22
EXPOSE 8082

RUN docker-php-ext-configure zip

RUN docker-php-ext-install zip

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install exif
RUN docker-php-ext-install fileinfo

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install memcached

RUN echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY ./php.ini /usr/local/etc/php

WORKDIR /app
