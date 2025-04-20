FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache rewrite module (optional)
RUN a2enmod rewrite

# Copy project files to Apache server directory
COPY patient_record_system /var/www/html/

# Fix permissions (optional but good practice)
RUN chmod -R 755 /var/www/html
