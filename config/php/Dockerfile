FROM php:8.0.0-fpm-alpine

ARG user
ARG uid

# Install PHP extensions
RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd && apk del libpng-dev

RUN apk add --no-cache zip libzip-dev && docker-php-ext-install zip


RUN docker-php-ext-install pdo pdo_mysql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Get npm
# RUN apk add --update npm

USER root

RUN  adduser -G www-data -u $uid -h /home/$user -D $user && addgroup $user root && addgroup $user  && addgroup $user $user

RUN  chown -R $user:$user /var/www/html

RUN  chmod -R 755 /var/www/html

RUN mkdir -p /home/$user/.composer
RUN chown -R $user:$user /home/$user

USER $user