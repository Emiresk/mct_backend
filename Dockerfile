FROM php:apache

RUN echo "memory_limit = 8196M" > /usr/local/etc/php/conf.d/memory-limit.ini
RUN a2enmod rewrite

COPY ./html /var/www/html