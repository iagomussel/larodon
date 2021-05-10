FROM alpine:3.7 as base
RUN apk add --no-cache git

WORKDIR /app
#download source
RUN git clone https://github.com/iagomussel/larodon.git .

COPY .env .
#
# PHP Dependencies
#
FROM composer:2.0 as vendor

WORKDIR /app

COPY --from=base /app .

RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist \
    --ignore-platform-reqs

RUN composer dump-autoload


#
# Frontend
#
FROM node:14.9 as frontend

WORKDIR /app

COPY --from=vendor /app/ .

RUN rm -f package.lock

RUN npm install

RUN npm run production

#
# Application
#
FROM php:8.0.5-apache as end

WORKDIR /app

# Install PHP dependencies
RUN apt-get update -y && apt-get install -y libxml2-dev
RUN docker-php-ext-install pdo pdo_mysql

#set apache document root
RUN sed -i 's/\/var\/www\/html/\/delivered\/app\/public/g' /etc/apache2/sites-available/000-default.conf


# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Frontend build
COPY --from=frontend /app/ .

RUN chmod -R 777 storage

RUN php artisan key:generate

CMD cp -nr /app /delivered&& apache2-foreground