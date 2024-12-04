# FROM php:8.2-fpm

# # Instalar extensões necessárias
# RUN apt-get update && apt-get install -y \
#     libpq-dev \
#     libzip-dev \
#     zip \
#     unzip \
#     && docker-php-ext-install pdo pdo_mysql

# Adicionando o Nginx
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    libzip-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY nginx.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["sh", "-c", "service nginx start && php-fpm"]



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
