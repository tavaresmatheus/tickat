FROM php:8.2-fpm

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php

RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

CMD bash -c "composer install --no-interaction --no-plugins --no-scripts --no-dev --prefer-dist"

CMD ["php-fpm"]
