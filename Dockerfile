FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libicu-dev \
    && apt-get install zip -y \
    && apt-get install unzip -y \
    && apt-get install libzip-dev -y \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl

WORKDIR /var/www/html

#FROM php_base as project_composer # add back in after project init
RUN apt-get install git -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

#FROM project_composer as prod_build
COPY . /var/www/html
RUN composer install -o --apcu-autoloader
RUN ls
