#!/bin/bash

# Start PHP-FPM in background
php-fpm -D

# Run Laravel setup commands
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Create storage symlink
php artisan storage:link || true

# Start Nginx in foreground
nginx -g "daemon off;"
