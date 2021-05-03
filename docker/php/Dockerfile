FROM php:8.0.3-fpm

WORKDIR /app

COPY ./composer.json composer.json
COPY ./composer.lock composer.lock

RUN docker-php-ext-install bcmath && \
	apt-get update && \
	apt-get install zip -y

# Install composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer