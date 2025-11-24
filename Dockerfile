FROM dunglas/frankenphp:php8.3-bookworm

# Set working directory
WORKDIR /app

# Copy project files into container
COPY . .

# Install dependencies (skip dev packages for production)
RUN composer install --no-dev --optimize-autoloader

# Expose port and run Laravel
CMD php artisan serve --host 0.0.0.0 --port $PORT
