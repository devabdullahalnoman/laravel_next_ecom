#!/bin/sh

# Run migrations on container start
php artisan migrate:fresh && php artisan db:seed

php artisan config:clear && php artisan view:clear && php artisan cache:clear

# Start PHP server
php -S 0.0.0.0:8000 -t public
