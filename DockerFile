FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Update DocumentRoot to point to the public directory if needed
# RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/' /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY . /var/www/html/

# Create necessary directories and set permissions
RUN mkdir -p /var/www/html/runtime/logs \
    && mkdir -p /var/www/html/runtime/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/runtime

# Expose port (Render will use this)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]