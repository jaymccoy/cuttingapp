FROM php:7-apache
RUN apt-get update \
    && apt-get install -y \
        mc \
        vim

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY start-apache /usr/local/bin
RUN a2enmod rewrite

# Copy application source
COPY src /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chown -R www-data:www-data /etc/apache2

#User www-data

CMD ["start-apache"]
