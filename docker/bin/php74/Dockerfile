FROM php:7.4-apache

ENV COMPOSER_ALLOW_SUPERUSER=1
ARG WWWUSER

# git, unzip & zip are for composer
RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    gnupg \
    unzip \
    zip \
    libpq-dev \ 
    libzip-dev \
    libpng-dev  

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Other PHP Extensions
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install zip
RUN docker-php-ext-install gettext 
RUN docker-php-ext-install exif 
RUN docker-php-ext-install  gd

# Enable apache modules
RUN a2enmod rewrite headers

RUN useradd -ms /bin/bash --no-user-group -g www-data $WWWUSER

# Cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/src/*
