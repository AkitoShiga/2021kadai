FROM php:7.3-fpm-alpine

ARG TZ

RUN apk upgrade --update && \
    apk --no-cache add tzdata && \
    cp /usr/share/zoneinfo/${TZ} /etc/localtime

ENV TZ=${TZ}

RUN apk upgrade --update && \
  apk --no-cache add icu-dev autoconf make g++ gcc npm libzip-dev postgresql-dev gmp-dev gmp

RUN docker-php-ext-install  -j$(nproc) iconv intl mbstring pdo_pgsql pdo_mysql opcache zip gmp && \
  pecl install xdebug-2.7.0beta1 && \
  docker-php-ext-enable xdebug

RUN apk add vim

RUN { \
  echo 'short_open_tag = On'; \
  echo 'fastcgi.logging = 1'; \
  echo 'opcache.enable=1'; \
  echo 'opcache.optimization_level=0x7FFFBBFF' ; \
  echo 'opcache.revalidate_freq=0'; \
  echo 'opcache.validate_timestamps=1'; \
  echo 'opcache.memory_consumption=128'; \
  echo 'opcache.interned_strings_buffer=8'; \
  echo 'opcache.max_accelerated_files=4000'; \
  echo 'opcache.revalidate_freq=60'; \
  echo 'opcache.fast_shutdown=1'; \
} > /usr/local/etc/php/conf.d/overrides.ini
RUN { \
  echo 'xdebug.remote_enable=1'; \
  echo 'debug.remote_connect_back=1';\
  echo 'xdebug.remote_log=/tmp/xdebug.log';\
  echo 'xdebug.remote_port=9001';\
  echo 'xdebug.remote_host=host.docker.internal';\
  echo 'xdebug.idekey=PHPSTORM';\
  echo 'xdebug.remote_autostart=1';\
  } >> /usr/local/etc/php/conf.d/dpcker-php-ext-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node:14.16.1 /usr/local/bin /usr/local/bin
COPY --from=node:14.16.1 /usr/local/lib /usr/local/lib
# Composer

# composer global require laravel/installer
# laravel=$HOME/.config/composer/vendor/bin
