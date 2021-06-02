#!/bin/bash
set -ex
composer install --ignore-platform-reqs
composer dump-autoload
npm install
npm run production
chmod -R 777 storage
php artisan key:generate
php artisan migrate
//seed database tests entry
echo "factory(App\Dentistas::class, 4)->make();factory(App\Pacientes::class, 50)->make();">tinkerfile.txt
php artisan tinker < ./tinkerfile.txt
rm -f tinkerfile
apache2-foreground