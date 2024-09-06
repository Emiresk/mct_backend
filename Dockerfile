FROM php:apache AS php-apache
RUN echo "memory_limit = 8196M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && a2enmod rewrite
COPY ./html /var/www/html


#FROM python:3.9-slim AS python-app
#WORKDIR /app

#COPY requirements.txt .
#RUN pip install --no-cache-dir -r requirements.txt

#FROM php-apache
#COPY --from=python-app /app /var/www/html/cronpy

