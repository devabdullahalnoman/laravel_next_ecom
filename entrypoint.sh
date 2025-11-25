#!/bin/sh

# Run migrations on container start
php artisan migrate --force

php artisan config:clear && php artisan view:clear && php artisan cache:clear

# Start PHP server
php -S 0.0.0.0:8000 -t public
