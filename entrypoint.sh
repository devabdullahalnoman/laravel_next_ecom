#!/bin/sh

# Run migrations on container start
php artisan migrate --force

# Start PHP server
php -S 0.0.0.0:8000 -t public
