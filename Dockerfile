FROM php:8.4-apache

# Set working environment
ENV DEBIAN_FRONTEND=noninteractive

# Update repository and install required system packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    curl \
    git \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions: intl, mbstring, pdo_mysql, mysqli, zip, gd, curl, opcache
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        intl \
        mbstring \
        pdo_mysql \
        mysqli \
        zip \
        gd \
        curl \
        opcache

# Enable required Apache modules: rewrite and headers
RUN a2enmod rewrite headers

# Copy custom Apache VirtualHost configuration
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Set working directory inside container
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Setup proper ownership and directory permissions for writable and cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/writable

# Expose standard HTTP port
EXPOSE 80

# Run Apache in foreground
CMD ["apache2-foreground"]

