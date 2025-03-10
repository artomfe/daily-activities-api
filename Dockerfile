FROM php:8.2-fpm

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure o diretório de trabalho
WORKDIR /var/www/html

# Copie os arquivos do projeto
COPY . .

# Execute o Composer para instalar dependências
RUN composer install

# Comando padrão
CMD php artisan serve --host=0.0.0.0 --port=8000
