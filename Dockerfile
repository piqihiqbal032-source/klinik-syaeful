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

# Install dependency Composer
RUN composer install --no-dev --optimize-autoloader

# --- BUILD CSS & JS (TAILWIND / VITE) ---
RUN npm ci || npm install
RUN npm run build
# ----------------------------------------

# Atur izin folder dasar
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Berikan izin eksekusi pada script entrypoint
RUN chmod +x /var/www/html/entrypoint.sh

EXPOSE 8000

# Jalankan entrypoint script
ENTRYPOINT ["/var/www/html/entrypoint.sh"]