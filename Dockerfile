# Stage 1: Build Node.js assets
FROM node:20 AS frontend
WORKDIR /app
# Copy only package files first for better caching
COPY package*.json ./
RUN npm install
# Copy the rest of the application
COPY . .
# Build Vite/Tailwind assets
RUN npm run build

# Stage 2: Build PHP and Nginx
FROM php:8.2-fpm

# Install system dependencies for PostgreSQL and Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Copy built frontend assets from the node stage
COPY --from=frontend /app/public/build /var/www/public/build

# Debugging checks for Vite assets
RUN ls -la public/build
RUN cat public/build/manifest.json

# Install Laravel dependencies (production optimized)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set permissions for storage and bootstrap/cache and public
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public

# Nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Ensure entrypoint is executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port (Render sets PORT environment variable, handled by entrypoint.sh)
EXPOSE 80

# Start PHP-FPM and Nginx
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
