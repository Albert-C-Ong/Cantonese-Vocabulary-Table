FROM ubuntu:latest
FROM php:8.1-apache  

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    nano \
    sqlite3 libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod php

ENV LANG C.UTF-8

COPY . /var/www/html

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]

