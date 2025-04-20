FROM php:8.2-apache

# Enable .htaccess and URL rewrite (optional)
RUN a2enmod rewrite

# Copy public folder if that's where your index.php is
COPY patient_record_system /var/www/html/

# Fix permissions
RUN chmod -R 755 /var/www/html
