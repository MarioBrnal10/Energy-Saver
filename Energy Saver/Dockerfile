# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . .

# Exponer el puerto 5000
EXPOSE 5000

# Cambiar el puerto por defecto de Apache a 5000
RUN sed -i 's/80/5000/g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/80/5000/g' /etc/apache2/ports.conf

# Dar permisos a los archivos (opcional, según necesidad)
RUN chown -R www-data:www-data /var/www/html

# Reiniciar Apache para aplicar cambios
CMD ["apache2-foreground"]
