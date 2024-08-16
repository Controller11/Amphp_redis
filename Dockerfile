# install PHP
FROM php:8.3-fpm

# install Composer for add app dependencies
FROM composer:2.0
COPY --from=composer /usr/bin/composer /usr/bin/composer

# require app dependencies with Composer
RUN composer require amphp/amp:^2
RUN composer require amphp/redis:^1

#copying test PHP file to app
COPY index.php /app/