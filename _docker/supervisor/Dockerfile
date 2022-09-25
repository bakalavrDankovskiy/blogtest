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
      docker-php-ext-install exif && \
      docker-php-ext-install pcntl && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update -yqq && \
    apt-get install -y zlib1g-dev libicu-dev g++ && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

#####################################
# PHP REDIS EXTENSION FOR PHP 7.0
#####################################
RUN printf "\n" | pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Install supervisor

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    supervisor \
  && rm -rf /var/qlib/apt/lists/*

CMD  ["supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]

WORKDIR /etc/supervisor/conf.d/
