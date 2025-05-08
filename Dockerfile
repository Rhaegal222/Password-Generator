# Usa l'immagine PHP con FPM
FROM php:8.2-fpm

# Installa le estensioni necessarie
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    mariadb-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Copia il codice sorgente
COPY . .

# Installa dipendenze Laravel
RUN composer install --no-dev --optimize-autoloader

# Imposta i permessi su storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copia gli script di entrypoint e attesa
COPY entrypoint.sh /entrypoint.sh

# Rendi eseguibili gli script
RUN chmod +x /entrypoint.sh

# Usa entrypoint.sh come punto di ingresso
ENTRYPOINT ["/entrypoint.sh"]

# Espone la porta per PHP-FPM
EXPOSE 9000
