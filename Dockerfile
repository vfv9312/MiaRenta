# Usamos la imagen oficial de PHP con FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Definimos variables que vienen desde el docker-compose.yml (usuario y su ID)
ARG user
ARG uid

# Instalamos las dependencias del sistema necesarias para Linux
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalamos Node.js y NPM (Versión 18) para poder usar Vite y compilar assets
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Limpiamos el caché de paquetes para reducir el tamaño de la imagen
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos las extensiones de PHP que Laravel necesita para funcionar (MySQL, BCMath, etc.)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copiamos la versión más reciente de Composer desde su imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Creamos un usuario de sistema igual al de tu Mac para evitar problemas de permisos de archivos
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Establecemos la carpeta de trabajo dentro del contenedor
WORKDIR /var/www

# Cambiamos al usuario que acabamos de crear
USER $user
