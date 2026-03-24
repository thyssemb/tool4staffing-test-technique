FROM php:8.4-apache

# Installer dépendances et extensions PHP
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    wget \
    && docker-php-ext-install zip pdo pdo_mysql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Installer PHPUnit
RUN wget https://phar.phpunit.de/phpunit-10.phar -O /usr/local/bin/phpunit \
    && chmod +x /usr/local/bin/phpunit

# Copier le projet
COPY . /var/www/html/
WORKDIR /var/www/html/

# Changer DocumentRoot pour /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Activer mod_rewrite pour router les requêtes
RUN a2enmod rewrite

# Autoriser Apache à accéder à /public
RUN printf "<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n" \
    > /etc/apache2/conf-available/project.conf \
    && a2enconf project

# Apache servira index.php par défaut
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

# Installer les dépendances PHP via Composer
RUN composer install --no-interaction --prefer-dist --dev \
    && composer dump-autoload