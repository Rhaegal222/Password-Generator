#!/bin/bash

HOST="db"
USER="root"
PASSWORD="root"
TIMEOUT=60
START_TIME=$(date +%s)

# Imposta i permessi per Laravel
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Aspetta che il database sia pronto
echo "Waiting for database to be ready..."

while true; do
    # Controlla la connessione MySQL
    if mysqladmin ping -h"$HOST" -u"$USER" -p"$PASSWORD" --silent; then
        echo "Database is ready!"
        break
    fi

    CURRENT_TIME=$(date +%s)
    ELAPSED=$(( CURRENT_TIME - START_TIME ))

    # Timeout se il database non risponde entro il tempo stabilito
    if [ "$ELAPSED" -ge "$TIMEOUT" ]; then
        echo "Timeout reached: Database is not responding."
        exit 1
    fi

    # Aspetta 3 secondi prima di riprovare
    echo "Database not ready yet. Retrying in 3 seconds..."
    sleep 3
done

# Esegue le migrazioni
php artisan migrate --force

# Avvia PHP-FPM
php-fpm
