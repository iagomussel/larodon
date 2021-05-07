FROM php:8.0.5-apache
#### this image has uploaded to hub, and this file is unused
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
RUN chmod -R 777 storage

#set apache document root
#RUN sed -i 's/\/var\/www\/html/\/var\/www\/public/g' /etc/apache2/sites-available/000-default.conf

# Configure Apache Document Root
ENV APACHE_DOC_ROOT /var/www/public

# Enable Apache mod_rewrite
RUN a2enmod rewrite


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


#set mysql
RUN docker-php-ext-install pdo_mysql


RUN npm install

RUN npm run production
RUN composer install --ignore-platform-reqs


RUN php artisan key:generate
