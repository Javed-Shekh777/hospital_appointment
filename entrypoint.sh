#!/bin/sh

# Clear Cache
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ensure Storage Link Exists   asset
if [ ! -L "public/storage" ]; then
    php artisan storage:link
fi

# Run Migrations & Seeding (Only in local/dev)
if [ "$APP_ENV" != "production" ]; then
    php artisan migrate:fresh --seed --force
else
    php artisan migrate --force
fi

# Cache Config & Routes for Performance
php artisan config:cache
php artisan route:cache

# Start Apache Server
apache2-foreground
