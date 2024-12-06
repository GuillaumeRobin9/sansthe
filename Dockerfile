FROM debian:latest

# ENV DEBIAN_FRONTEND=noninteractive
# ENV MYSQL_ROOT_PASSWORD=password

RUN apt-get update && apt-get install -y \
    apache2 \
    default-mysql-server \
    php \
    php-mysql \
    && apt-get clean

# Copier les fichiers de configuration
COPY data/rendezvous.sql /docker-entrypoint-initdb.d/rendezvous.sql
COPY data/user.sql /docker-entrypoint-initdb.d/user.sql

# Configurer MySQL
RUN service mysql start && \
    mysql -e "CREATE DATABASE sansthe;" && \
    mysql -e "USE sansthe; SOURCE /docker-entrypoint-initdb.d/rendezvous.sql;" && \
    mysql -e "USE sansthe; SOURCE /docker-entrypoint-initdb.d/user.sql;" 

# Configurer Apache
RUN echo "<?php phpinfo(); ?>" > /var/www/html/index.php


EXPOSE 80
EXPOSE 3306

# Démarrer les services
CMD service mysql start && apachectl -D FOREGROUND


