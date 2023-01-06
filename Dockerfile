FROM php:8.1-apache

RUN a2enmod rewrite

RUN apt-get update


RUN apt-get update -y

# Add Node 8 LTS
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -- \
	&& apt-get install -y nodejs \
	&& apt-get autoremove -y

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY  docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY  docker/.env-pro /var/www/html/.env
COPY  docker/php.ini /usr/local/etc/php/php.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY  . /var/www/html/
WORKDIR /var/www/html/

RUN cd /

# RUN chown www-data:www-data /var/www/html  \
#      && composer install  && composer dumpautoload
