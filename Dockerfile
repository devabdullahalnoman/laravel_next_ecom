# Use PHP 8.3 FrankenPHP image
FROM dunglas/frankenphp:php8.3-bookworm

# Set working directory
WORKDIR /app

# Install Composer and required tools
RUN apt-get update && apt-get install -y curl git unzip zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files into container
COPY . .

# Install Laravel dependencies (skip dev packages for production)
RUN composer install --no-dev --optimize-autoloader

# Expose port and run Laravel using PHP's built-in server
CMD php -S 0.0.0.0:8000 -t public
