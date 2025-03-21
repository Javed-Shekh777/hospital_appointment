# Step 1: Use official PHP image
FROM php:8.2-fpm

# Step 2: Install necessary extensions & dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Step 3: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 4: Set working directory
WORKDIR /var/www/html

# Step 5: Copy Laravel files
COPY . .

# Step 6: Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Step 7: Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Step 8: Expose port
EXPOSE 9000

# Step 9: Start PHP-FPM server
CMD ["php-fpm"]
