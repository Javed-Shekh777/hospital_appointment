#!/bin/sh

# Install Dependencies
composer install --optimize-autoloader --no-dev
composer dump-autoload
composer require fakerphp/faker --dev

# Clear Cache
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

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
