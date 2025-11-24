FROM dunglas/frankenphp:php8.3-bookworm

# Set working directory
WORKDIR /app

# Install Composer manually
RUN apt-get update && apt-get install -y curl git unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files into container
COPY . .

# Install dependencies (skip dev packages for production)
RUN composer install --no-dev --optimize-autoloader

# Expose port and run Laravel
CMD ["frankenphp", "run", "--config", "/Caddyfile"]
