FROM php:8.2-apache

# Active les modules Apache utiles
RUN a2enmod rewrite

# Installe les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copie ton code
WORKDIR /var/www/html
COPY . .

# Active les règles de réécriture (pour AltoRouter)
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
    </Directory>" > /etc/apache2/conf-available/rewrite.conf \
    && a2enconf rewrite

EXPOSE 80
