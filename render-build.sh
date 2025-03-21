#!/bin/sh

echo "Running Laravel Migrations..."
php artisan cache:table
php artisan migrate --force || true

echo "Clearing Laravel Cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache

echo "Creating Storage Symlink..."
php artisan storage:link || true

echo "Setting Proper Permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "Starting Apache Server..."
apache2-foreground
