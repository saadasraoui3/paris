#!/bin/sh
set -e

# Wait for MySQL
until php -r "new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));" 2>/dev/null; do
    echo "Waiting for database..."
    sleep 2
done

php artisan package:discover --ansi
php artisan storage:link || true
php artisan migrate --force
php artisan optimize:clear

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
