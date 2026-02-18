# Step 1: Official PHP-FPM image
FROM php:8.4-fpm

# Step 2: Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Step 3: Install PHP extensions required for Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Step 4: Set working directory
WORKDIR /var/www

# Step 5: Copy project files including vendor
COPY . .

# Step 6: Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Step 7: Expose port
EXPOSE 8000

# Step 8: Start Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
