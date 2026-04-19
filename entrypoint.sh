#!/bin/bash
set -e

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

if [ -n "$DB_HOST" ]; then
    echo "Waiting for database at $DB_HOST..."
    until php -r "new PDO('mysql:host=$DB_HOST;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');" 2>/dev/null; do
        sleep 2
    done
    echo "Database ready."
fi

php artisan migrate --force --no-interaction
php artisan config:cache
php artisan route:cache

exec php-fpm
