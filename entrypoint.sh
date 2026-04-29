#!/bin/bash
set -e

if [ "$(id -u)" = "0" ]; then
    chown -R 1000:1000 /var/www/html/storage /var/www/html/bootstrap/cache
else
    echo "Skipping chown: running as uid $(id -u)."
fi

if [ -n "$DB_HOST" ]; then
    echo "Waiting for database at $DB_HOST..."
    until php -r 'new PDO("mysql:host=".getenv("DB_HOST").";dbname=".getenv("DB_DATABASE"), getenv("DB_USERNAME"), getenv("DB_PASSWORD"));' 2>/dev/null; do
        sleep 2
    done
    echo "Database ready."
fi

php artisan migrate --force --no-interaction
php artisan config:cache
php artisan route:cache

exec php-fpm
