FROM php:8.1.7-fpm

RUN apt-get update && apt-get install -y \
    libonig-dev \
      apt-utils \
    libxml2-dev \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git \
      supervisor && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install mbstring && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      docker-php-ext-install xml && \
      docker-php-ext-install pcntl && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini


# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www/
