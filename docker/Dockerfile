FROM php:8.1-apache

# Install MySQL extensions: both PDO and mysqli
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copy your application code in
COPY ./app /var/www/html/

EXPOSE 80
