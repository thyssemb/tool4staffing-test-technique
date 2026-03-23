FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

WORKDIR /var/www/html/

RUN a2enmod rewrite

RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" > /etc/apache2/conf-available/project.conf \
    && a2enconf project

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

RUN composer install --no-interaction --prefer-dist