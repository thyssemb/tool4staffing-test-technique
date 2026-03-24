FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    wget \
    && docker-php-ext-install zip pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN wget https://phar.phpunit.de/phpunit-10.phar -O /usr/local/bin/phpunit \
    && chmod +x /usr/local/bin/phpunit

COPY . /var/www/html/
WORKDIR /var/www/html/

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN printf "<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n" \
    > /etc/apache2/conf-available/project.conf \
    && a2enconf project

RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

RUN composer install --no-interaction --prefer-dist --dev \
    && composer dump-autoload