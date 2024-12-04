# FROM php:8.2-fpm

# # Instalar extensões necessárias
# RUN apt-get update && apt-get install -y \
#     libpq-dev \
#     libzip-dev \
#     zip \
#     unzip \
#     && docker-php-ext-install pdo pdo_mysql

# Use uma imagem base PHP com FPM
FROM php:8.2-fpm

# Instalar dependências e extensões necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip bcmath opcache

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do Composer e instalar dependências
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copiar o restante do código
COPY . .

# Configurar permissões
RUN mkdir -p /var/www/storage/framework/cache/data \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Definir variáveis de ambiente
ENV APP_ENV=production

# Expor a porta 9000
EXPOSE 9000

# Comando padrão
CMD ["php-fpm"]
