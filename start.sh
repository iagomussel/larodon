#!/bin/bash
set -ex
composer install --ignore-platform-reqs
composer dump-autoload
npm install
npm run production
chmod -R 777 storage
php artisan key:generate
php artisan migrate
apache2-foreground