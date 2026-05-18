#!/bin/bash
# Provide a default PORT if not set by Render
PORT="${PORT:-80}"

# Substitute PORT in Nginx configuration
sed -i "s/\${PORT}/$PORT/g" /etc/nginx/sites-available/default

# Cache Laravel configuration before starting (optional but recommended for production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automatically
echo "Running database migrations..."
php artisan migrate --force

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
nginx -g "daemon off;"
