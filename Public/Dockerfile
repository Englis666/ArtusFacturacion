# Usa una imagen base de PHP
FROM php:8.1-fpm

# Instala las dependencias necesarias (por ejemplo, ext-mysqli y ext-pdo)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Comando para iniciar PHP-FPM
CMD ["php-fpm"]
