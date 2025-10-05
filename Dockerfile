FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-install intl pdo_mysql opcache zip \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/log /var/www/html/temp