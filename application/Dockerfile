#
# PHP Dependencies
#
FROM composer:2.0 as vendor

WORKDIR /app

COPY . .

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

# Copy Frontend build
COPY --from=frontend /app/ .

RUN php artisan key:generate