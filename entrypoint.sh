#!/bin/bash

# Hentikan eksekusi jika ada command yang gagal
set -e

echo "=== Menjalankan Clear Cache ==="
php artisan config:clear
php artisan cache:clear

echo "=== Menjalankan Migrasi Database PostgreSQL ==="
php artisan migrate --force

echo "=== Memulai Web Server Apache ==="
exec apache2-foreground