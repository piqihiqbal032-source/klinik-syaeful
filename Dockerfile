# 1. Base image PHP 8.3 dengan Apache
FROM php:8.3-apache

# 2. Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# 3. Install ekstensi PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy semua file ke container
COPY . .

# 7. Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# file .env sebelum generate key
RUN touch .env

# 8. Generate APP_KEY
RUN php artisan key:generate

# 9. Jalankan migration
RUN php artisan migrate --force

# 10. Set permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Expose port
EXPOSE 8000

# 12. Start server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]