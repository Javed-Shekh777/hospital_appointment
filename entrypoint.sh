#!/bin/sh

# Clear old caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan event:clear
php artisan optimize:clear

# Storage Link (अगर images ना दिख रही हों)
php artisan storage:link

# Run Laravel Migrations (Clean Start)
php artisan migrate:fresh --seed --force

php artisan db:seed --class=DoctorSeeder --force

# Cache Config for Performance
php artisan config:cache

# Start Apache server
apache2-foreground
