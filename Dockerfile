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
    && docker-php-ext-install pdo pdo_mysql

# Instalar o Composer (gerenciador de dependências do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho dentro do contêiner
WORKDIR /var/www

# Copiar todo o código do projeto (incluindo o arquivo artisan)
COPY . .

# Instalar as dependências do Laravel com o Composer
RUN composer install --no-dev --optimize-autoloader

# Definir as permissões apropriadas para os diretórios do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor a porta 9000 para o PHP-FPM
EXPOSE 9000

# Configurar o comando padrão para o contêiner
CMD ["php-fpm"]


# server {
#     listen 80;
#     index index.php index.html;
#     server_name localhost;

#     root /var/www/html/public;

#     location / {
#         try_files $uri $uri/ /index.php?$query_string;
#     }

#     location ~ \.php$ {
#         include fastcgi_params;
#         fastcgi_pass app:9000;
#         fastcgi_index index.php;
#         fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
#     }

#     location ~ /\.ht {
#         deny all;
#     }
# }
