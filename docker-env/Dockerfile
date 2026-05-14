FROM php:8.2-apache

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

RUN sed -i '/<\/VirtualHost>/i\\t<Directory /var/www/html>\n\t\tAllowOverride All\n\t\tRequire all granted\n\t</Directory>' /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html