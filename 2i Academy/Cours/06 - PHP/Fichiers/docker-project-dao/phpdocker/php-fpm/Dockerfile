FROM phpdockerio/php:8.4-fpm
WORKDIR "/application"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.4-gd \
        php8.4-mysql \
        php8.4-sqlite3 \
        php8.4-xdebug \
        php8.4-yaml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
