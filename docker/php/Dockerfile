FROM php:8.3-apache

# Activer les modules Apache rewrite et headers
RUN a2enmod rewrite headers

# Installer les dépendances nécessaires pour PHP et amqp
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    librabbitmq-dev \
    libssl-dev \
    pkg-config \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && pecl install amqp \
    && docker-php-ext-enable amqp

# Copier Composer depuis l'image composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le fichier de configuration Apache
COPY ./docker/web/apache.conf /etc/apache2/sites-available/000-default.conf

# Copier le projet dans le conteneur
COPY . /var/www

# Définir le répertoire de travail
WORKDIR /var/www

# Installer les dépendances PHP avec Composer
RUN composer install --no-interaction --optimize-autoloader

# Changer les permissions des fichiers
RUN chown -R www-data:www-data /var/www

# Exposer le port 80
EXPOSE 80

# Commande par défaut pour démarrer Apache
CMD ["apache2-foreground"]
