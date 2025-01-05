#!/bin/bash

# Imposta i permessi per Laravel
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Esegue le migrazioni
php artisan migrate --force

# Avvia PHP-FPM
php-fpm
