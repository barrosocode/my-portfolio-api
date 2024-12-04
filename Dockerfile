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

# Instalar dependências e extensões necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip bcmath opcache


# Instalar o Composer (gerenciador de dependências do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho dentro do contêiner
WORKDIR /var/www

# Copiar o arquivo composer.json e composer.lock para o contêiner
COPY composer.json composer.lock ./

# Instalar as dependências do Laravel com o Composer
RUN composer install --no-dev --optimize-autoloader

# Copiar o restante do código do projeto
COPY . .

# Definir as permissões apropriadas para os diretórios do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor a porta 9000 para o PHP-FPM
EXPOSE 9000

# Configurar o comando padrão para o contêiner
CMD ["php-fpm"]
