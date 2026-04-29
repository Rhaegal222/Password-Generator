FROM php:8.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev libjpeg-dev libfreetype6-dev \
        libonig-dev libxml2-dev \
        zip unzip curl nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY service/composer.json service/composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY service/ .
RUN composer dump-autoload --optimize

COPY service/package.json service/package-lock.json ./
ARG VITE_BASE_URL=/password-generator/
ENV VITE_BASE_URL=${VITE_BASE_URL}
RUN npm ci && npm run build && rm -rf node_modules

RUN chown -R 1000:1000 storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["/entrypoint.sh"]
