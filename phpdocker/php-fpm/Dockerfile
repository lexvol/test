FROM phpdockerio/php74-fpm:latest
WORKDIR "/application"

# Install selected extensions and other stuff
RUN apt-get update \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd \
    && apt-get -y --no-install-recommends install  php7-mysql php7-gd php7-intl php7-imagick php7-xdebug php7.4-xmlrpc \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*