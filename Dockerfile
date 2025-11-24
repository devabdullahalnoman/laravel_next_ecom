FROM dunglas/frankenphp:php8.3-bookworm

WORKDIR /app

# Install Composer
RUN apt-get update && apt-get install -y curl git unzip zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . .

# Install Laravel dependencies (skip dev packages for production)
RUN composer install --no-dev --optimize-autoloader

# Fix permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache

# Run migrations AFTER dependencies are installed
RUN php artisan migrate --force

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
