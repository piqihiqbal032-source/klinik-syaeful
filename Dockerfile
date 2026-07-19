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

# Install dependency dulu
RUN composer install --no-dev --optimize-autoloader

# Setup environment
RUN if [ -f .env.production ]; then cp .env.production .env; else touch .env; fi
RUN php artisan key:generate
RUN php artisan storage:link --force
RUN php artisan config:clear

# Debug: Cek koneksi database
RUN php artisan config:clear
RUN php artisan cache:clear || true
RUN echo "=== Testing Database Connection ==="
RUN php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'Connected!'; } catch(Exception $e) { echo 'Error: '.$e->getMessage(); }" || true
RUN echo "=== Environment Variables ==="
RUN echo "DB_CONNECTION: $(grep DB_CONNECTION .env || echo 'NOT FOUND')"
RUN echo "DB_HOST: $(grep DB_HOST .env || echo 'NOT FOUND')"
RUN echo "DB_DATABASE: $(grep DB_DATABASE .env || echo 'NOT FOUND')"
RUN echo "DB_USERNAME: $(grep DB_USERNAME .env || echo 'NOT FOUND')"
RUN echo "DB_PASSWORD: $(grep DB_PASSWORD .env || echo 'NOT FOUND')"
RUN echo "=== End of Environment Variables ==="

# Jalankan migration (BUAT TABEL)
RUN php artisan migrate --force
RUN php artisan db:seed --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]