FROM php:8.0.6-apache 

WORKDIR /var/www

EXPOSE 80

#set apache document root
RUN sed -i 's/\/var\/www\/html/\/var\/www\/public/g' /etc/apache2/sites-available/000-default.conf


# Install PHP dependencies
RUN apt-get update -y && apt-get install -y libxml2-dev curl git


RUN docker-php-ext-install pdo pdo_mysql
#install some base extensions
RUN apt-get install -y \
        zlib1g-dev \
        libzip-dev \
        zip
RUN docker-php-ext-install zip

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get update -y && apt-get install -y nodejs

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite
COPY ./start.sh /tmp

COPY ./wait.html /tmp
RUN chmod +x /tmp/start.sh
RUN  sed -i -e 's/\r$//' /tmp/start.sh
RUN npm install -g http-server pm2


CMD [ "/tmp/start.sh" ]