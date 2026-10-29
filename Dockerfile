# --- Frontend assets (Vite) ---
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm run build

# --- PHP dependencies ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs

# --- App ---
FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql intl zip gd bcmath exif opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN printf "upload_max_filesize=10M\npost_max_size=12M\nmemory_limit=256M\n" > /usr/local/etc/php/conf.d/uploads.ini

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

RUN composer dump-autoload --optimize --no-dev \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
