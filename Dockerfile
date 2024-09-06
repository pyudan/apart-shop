# Utilise php version 8
FROM php:8.0-apache

# Le repertoire de travail
WORKDIR /var/www/html

# Installe les dependances systeme
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install intl mbstring zip opcache

# Active le mode mod_rewrite d'Apache
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie les fichiers
COPY . .

# Installe les dependances du projet
RUN composer install --no-dev --optimize-autoloader

# Donne la permission web au serveur
RUN chown -R www-data:www-data /var/www/html

# Ouvre le port 80
EXPOSE 80

# Lance le serveur
CMD ["apache2-foreground"]
