FROM php:8.0.5-apache

#install dependencies
RUN apt-get update && apt-get install -y git curl lsb-release gnupg

#install node
RUN curl -sL https://deb.nodesource.com/setup_15.x | bash
RUN apt install -y nodejs


#npm updating    
RUN npm i npm@latest -g

WORKDIR /var/www
RUN mv /var/www/html /var/www/public
COPY . .
RUN chmod -R 777 ./storage
#set apache document root
RUN sed -i 's/\/var\/www\/html/\/var\/www\/public/g' /etc/apache2/sites-available/000-default.conf
 
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


RUN npm install

RUN npm run production
RUN composer install --ignore-platform-reqs
RUN docker-php-ext-install pdo_mysql
RUN php artisan key:generate
RUN php artisan migrate