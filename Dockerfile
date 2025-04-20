FROM php:8.2-apache

# Copy your PHP files to the apache server's root directory
COPY patient_record_system/var/www/html/

# Enable Apache Rewrite Module (optional, for Laravel, routing, etc.)
RUN a2enmod rewrite
