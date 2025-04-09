# Use official PHP + Apache image
FROM php:8.2-apache

# Install required extensions & dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Copy custom Apache config to serve from public folder
COPY apache.conf /etc/apache2/sites-available/000-default.conf


# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Install Laravel dependencies (Only once, no repetition in entrypoint)
RUN composer install --optimize-autoloader --no-dev
RUN composer require fakerphp/faker --dev

RUN composer dump-autoload

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy entrypoint script and give it execute permission
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose HTTP port
EXPOSE 80

# Run the entrypoint script
CMD ["/entrypoint.sh"]


