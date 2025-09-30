FROM php:8.2-apache

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copy app files
COPY . /var/www/html/

# Create necessary directories and fix permissions
RUN mkdir -p /tmp/sessions /tmp/logs /tmp/cache /var/www/html/runtime/logs /var/www/html/runtime/cache \
    && chown -R www-data:www-data /var/www/html /tmp/sessions /tmp/logs /tmp/cache \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /tmp/sessions /tmp/logs /tmp/cache /var/www/html/runtime

EXPOSE 80

CMD ["apache2-foreground"]