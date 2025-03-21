#!/bin/sh

# Run Laravel Migrations
php artisan cache:table
php artisan migrate --force


# Optional: Clear Cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache

