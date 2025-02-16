FROM php:8.2-apache

# Instalar dependencias necesarias
RUN apt-get update && \
    apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Habilitar módulos necesarios de Apache
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el proyecto Laravel al contenedor
COPY . .

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Configurar el VirtualHost para Laravel
RUN echo '<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Exponer el puerto 80
EXPOSE 80

# Comando por defecto para iniciar Apache
CMD ["apache2-foreground"]

