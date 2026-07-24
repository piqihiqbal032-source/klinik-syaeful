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
    npm \
    libpq-dev

RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Install dependency & setup environment
RUN composer install --no-dev --optimize-autoloader
RUN if [ -f .env.production ]; then cp .env.production .env; else touch .env; fi
RUN php artisan key:generate
RUN php artisan storage:link --force

# Atur izin folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Berikan izin eksekusi pada script entrypoint
RUN chmod +x /var/www/html/entrypoint.sh

EXPOSE 8000

# Jalankan entrypoint script
ENTRYPOINT ["/var/www/html/entrypoint.sh"]