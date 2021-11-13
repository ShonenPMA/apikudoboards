FROM php:8.0.0-fpm-alpine

# Install PHP extensions
RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd && apk del libpng-dev

RUN apk add --no-cache zip libzip-dev && docker-php-ext-install zip


RUN docker-php-ext-install pdo pdo_mysql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Get npm
# RUN apk add --update npm
