# imagem base com PHP 8.4
FROM php:8.4-cli

# instala as extensoes que o laravel precisa pra funcionar
# pdo_mysql -> pra conectar no banco mysql
# mbstring, zip, exif, bcmath, gd -> usadas por bibliotecas comuns do laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif bcmath gd

# instala o composer (gerenciador de dependencias do php)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# pasta onde o projeto vai ficar dentro do container
WORKDIR /var/www/html

# copia todo o projeto pra dentro do container
COPY . .

# instala as dependencias do laravel
RUN composer install --no-interaction --no-dev --optimize-autoloader

# da permissao pras pastas que o laravel precisa escrever (cache, logs, sessao)
RUN chmod -R 775 storage bootstrap/cache

# porta que o servidor embutido do laravel vai usar
EXPOSE 8000

# comando que roda quando o container sobe
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
