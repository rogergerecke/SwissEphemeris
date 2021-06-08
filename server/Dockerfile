FROM php:7.4.0-apache-buster

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

# Install useful tools
RUN apt-get -y install --fix-broken

# Install important libraries
RUN apt-get -y install --fix-missing build-essential curl libcurl4 libcurl4-openssl-dev zip

# Install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Other PHP7 Extensions

RUN rm /etc/apt/preferences.d/no-debian-php

# Download packages
RUN apt-get -y install \
    zlib1g-dev \
    zlib1g-dev \
    libzip-dev

# Enable PHP extention
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    curl \
    zip

# unicode unterstützung
RUN apt-get -y install libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

# Enable apache modules
RUN a2enmod rewrite headers ssl