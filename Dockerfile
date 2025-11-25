FROM dunglas/frankenphp:php8.3-bookworm

WORKDIR /app

# Install Composer
RUN apt-get update && apt-get install -y curl git unzip zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo_mysql

# Copy project files
COPY . .

# Install Laravel dependencies (skip dev packages for production)
RUN composer install --no-dev --optimize-autoloader

# Fix permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN apt-get update && apt-get install -y nodejs npm \
    && npm install && npm run build

EXPOSE 8000

CMD ["/entrypoint.sh"]
