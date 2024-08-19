# install PHP
FROM php:8.3-fpm

# install Composer and copy app dependencies 
FROM composer:2.0
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json /app
RUN composer install

#copy index.php to app
COPY index.php /app