#!/bin/sh

# Check if composer.json exists
if [ -f composer.json ]; then
    composer install --no-interaction --optimize-autoloader
else
    echo "composer.json not found. Skipping Composer install."
fi

# Check if artisan exists before running Laravel commands
if [ -f artisan ]; then
    php artisan optimize
    # Check if APP_KEY exists in the .env file
    if [ -f .env ] && grep -q '^APP_KEY=' .env; then
        echo "APP_KEY already set. Skipping key generation."
    else
        echo "APP_KEY not found. Generating a new one."
        php artisan key:generate
    fi
    php artisan storage:link
    # php artisan migrate
else
    echo "artisan not found. Skipping Laravel commands."
fi

# Start PHP-FPM
php-fpm
