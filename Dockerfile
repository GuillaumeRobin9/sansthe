# syntax=docker/dockerfile:1
FROM debian:latest

RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    php-mysql \
    && apt-get clean

COPY . /var/www/html

RUN echo "<?php phpinfo(); ?>" > /var/www/html/index.php

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
