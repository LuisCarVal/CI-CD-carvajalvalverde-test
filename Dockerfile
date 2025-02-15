# Usa una imagen base de PHP con Apache
FROM php:8.2-apache

# Instala las extensiones necesarias de PHP para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    libfreetype6-dev \
    zip git npm \
    #curl ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Habilitar mod_rewrite de Apache para Laravel
RUN a2enmod rewrite

#Cambiar configuración de apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

#Instalar gestor de paquetes composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Instalar las dependencias del proyecto laravel
RUN composer install

# Cambiar permisos en las carpetas de almacenamiento y caché de Laravel
RUN chown -R www-data:www-data /var/www/html

#Instalamos las dependencias con npm
RUN npm i && npm run build

#Cambiar al usuario www-data
USER www-data