FROM php:8.2-cli

RUN apt-get update && apt-get install -y && apt-get install curl -y && apt-get install git -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

RUN apt-get update \
        && apt-get -y --no-install-recommends install \
                mc \
                zip \
                git \
                ssh \
                curl \
                wget \
                bash \
                nano \
                unzip \
                libpq-dev \
                libgmp-dev \
                libicu-dev \
                zlib1g-dev \
                libxml2-dev \
                libtidy-dev \
                libmemcached-dev \
                libmagickwand-dev \
                ghostscript \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


WORKDIR /app