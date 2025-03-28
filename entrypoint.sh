#!/bin/sh
composer install --optimize-autoloader
# Clear Old Caches
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

# Ensure Storage Link Exists
if [ ! -L "public/storage" ]; then
    php artisan storage:link
fi

# Run Migrations & Seeding
php artisan migrate:fresh --seed --force

# Cache Config & Routes for Performance
php artisan config:cache
php artisan route:cache

# Start Apache Server
apache2-foreground
