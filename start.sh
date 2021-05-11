#bin/bash
cd /var/www
exit
echo "composer install"
composer install --ignore-platform-reqs

echo "dump autoload"
composer dump-autoload

npm install
npm run production
chmod -R 777 storage
php artisan key:generate
php artisan migration
apache2-foreground