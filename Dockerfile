FROM php:8.3-apache

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

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 1. Copy semua file dulu
COPY . .

# 2. Install Composer 
RUN composer install --no-dev --optimize-autoloader

# 3. Buat .env dan generate key (SETELAH composer install)
RUN if [ -f .env.example ]; then cp .env.example .env; else touch .env; fi
RUN php artisan key:generate
RUN php artisan storage:link --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]