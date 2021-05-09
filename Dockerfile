FROM alpine:3.7 as base
RUN apk add --no-cache git
#### this image has uploaded to hub, and this file is unused
#install dependencies

WORKDIR /app

#download source
RUN git clone https://github.com/iagomussel/larodon.git .


#
# PHP Dependencies
#
FROM composer:2.0 as vendor

WORKDIR /app

COPY --from=base /app/ .
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist \
    --ignore-platform-reqs

COPY . .
RUN composer dump-autoload


#
# Frontend
#
FROM node:14.9 as frontend

WORKDIR /app

COPY --from=vendor /app/ .

RUN rm -f package.lock

RUN yarn install

RUN yarn production

#
# Application
#
FROM php:8.0.5-apache as end

WORKDIR /app

# Install PHP dependencies
RUN apt-get update -y && apt-get install -y libxml2-dev
RUN docker-php-ext-install pdo pdo_mysql opcache tokenizer xml ctype json bcmath pcntl

# Copy Frontend build
COPY --from=frontend /app/ .

RUN php artisan config:cache
RUN php artisan route:cache