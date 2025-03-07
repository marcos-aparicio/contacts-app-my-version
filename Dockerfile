# this docker file assumes you have a .env file with the correct variables inside it
FROM php:8.1

ENV TZ America/Toronto

RUN apt update &&\
    docker-php-ext-install mysqli pdo pdo_mysql &&\
    docker-php-ext-enable pdo_mysql

WORKDIR /var/www/html

COPY . .


CMD php -S 0.0.0.0:8000
