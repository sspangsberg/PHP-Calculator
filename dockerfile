FROM composer:latest AS builder
WORKDIR /app
COPY composer.json ./
RUN composer install --no-autoloader --no-scripts

FROM php:7.4-fpm-alpine
RUN docker-php-ext-install pdo_mysql
#-- Copy composer binary only in dev mode
#-- COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY --from=builder /app/vendor /var/www/html/vendor
COPY . /var/www/html/
WORKDIR /var/www/html
