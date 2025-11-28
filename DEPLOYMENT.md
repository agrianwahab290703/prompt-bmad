# Deployment Guide

Panduan untuk deploy BMAD Generator ke production.

## 🌐 Deployment Options

- [Shared Hosting](#shared-hosting)
- [VPS (Ubuntu)](#vps-ubuntu)
- [Docker](#docker)
- [Laravel Forge](#laravel-forge)
- [Heroku](#heroku)

---

## 🖥️ Shared Hosting

### Requirements
- PHP 8.3+
- Composer
- SSH access (recommended)

### Steps

1. **Upload Files**
```bash
# On your local machine
zip -r bmad-generator.zip . -x "vendor/*" "node_modules/*" ".git/*"
# Upload via FTP/cPanel
```

2. **Install Dependencies**
```bash
# SSH to server
cd public_html/bmad-generator
composer install --optimize-autoloader --no-dev
```

3. **Configure Environment**
```bash
cp .env.example .env
nano .env

# Set:
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
ZAI_API_KEY=your-key
```

4. **Generate Key**
```bash
php artisan key:generate
```

5. **Set Permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

6. **Configure Web Root**
Point your domain to the `public` directory.

### .htaccess (if needed)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

---

## 🖥️ VPS (Ubuntu)

### 1. Prepare Server

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.3
sudo add-apt-repository ppa:ondrej/php
sudo apt install -y php8.3 php8.3-cli php8.3-fpm \
    php8.3-mbstring php8.3-xml php8.3-curl \
    php8.3-sqlite3 php8.3-zip

# Install Nginx
sudo apt install -y nginx

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Git
sudo apt install -y git
```

### 2. Clone and Setup

```bash
# Clone repository
cd /var/www
sudo git clone <your-repo> bmad-generator
cd bmad-generator

# Install dependencies
composer install --optimize-autoloader --no-dev

# Setup environment
cp .env.example .env
nano .env

# Set production values
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
ZAI_API_KEY=your-key

# Generate key
php artisan key:generate

# Set permissions
sudo chown -R www-data:www-data /var/www/bmad-generator
sudo chmod -R 755 storage bootstrap/cache
```

### 3. Configure Nginx

```bash
sudo nano /etc/nginx/sites-available/bmad-generator
```

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/bmad-generator/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/bmad-generator /etc/nginx/sites-enabled/

# Test config
sudo nginx -t

# Restart Nginx
sudo systemctl restart nginx
```

### 4. SSL with Let's Encrypt

```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Get certificate
sudo certbot --nginx -d yourdomain.com

# Auto-renewal (already set up by certbot)
```

### 5. Optimize

```bash
# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

---

## 🐳 Docker

### Dockerfile

```dockerfile
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application
COPY . /var/www

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
```

### docker-compose.yml

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: bmad-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    networks:
      - bmad-network

  nginx:
    image: nginx:alpine
    container_name: bmad-nginx
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - bmad-network

networks:
  bmad-network:
    driver: bridge
```

### Deploy

```bash
# Build and run
docker-compose up -d

# Run migrations (if needed)
docker-compose exec app php artisan migrate

# Cache config
docker-compose exec app php artisan config:cache
```

---

## ⚙️ Laravel Forge

### 1. Create Server

1. Login to [Laravel Forge](https://forge.laravel.com)
2. Create new server (choose provider)
3. Select PHP 8.3

### 2. Create Site

1. Click "New Site"
2. Enter domain: `bmad.yourdomain.com`
3. Project type: General PHP / Laravel
4. Wait for provisioning

### 3. Deploy

1. Go to site settings
2. Git Repository: Connect your repo
3. Branch: `main`
4. Deploy script:
```bash
cd /home/forge/bmad.yourdomain.com

git pull origin main

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan optimize
```

5. Enable "Quick Deploy"

### 4. Environment

1. Go to "Environment"
2. Set variables:
```env
APP_ENV=production
APP_DEBUG=false
ZAI_API_KEY=your-key
```

### 5. SSL

1. Go to "SSL"
2. Select "LetsEncrypt"
3. Click "Obtain Certificate"

---

## 🟣 Heroku

### 1. Prepare

Create `Procfile`:
```
web: vendor/bin/heroku-php-apache2 public/
```

### 2. Deploy

```bash
# Login
heroku login

# Create app
heroku create bmad-generator

# Add buildpack
heroku buildpacks:set heroku/php

# Deploy
git push heroku main

# Set config
heroku config:set APP_KEY=$(php artisan key:generate --show)
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set ZAI_API_KEY=your-key

# Open app
heroku open
```

---

## 🔒 Security Checklist

### Before Production

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Change `APP_KEY`
- [ ] Use HTTPS (SSL certificate)
- [ ] Secure `.env` file
- [ ] Set proper file permissions
- [ ] Enable firewall
- [ ] Keep software updated
- [ ] Backup strategy
- [ ] Monitor logs
- [ ] Rate limiting
- [ ] CSRF protection enabled
- [ ] Validate all inputs

### File Permissions

```bash
# Directories
find . -type d -exec chmod 755 {} \;

# Files
find . -type f -exec chmod 644 {} \;

# Storage and cache (writable)
chmod -R 775 storage bootstrap/cache
```

---

## ⚡ Performance Optimization

### 1. Caching

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. OPcache (php.ini)

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
```

### 3. CDN

Use CDN for static assets (Tailwind CSS, Font Awesome).

### 4. Gzip Compression

Nginx:
```nginx
gzip on;
gzip_vary on;
gzip_min_length 10240;
gzip_types text/plain text/css text/xml text/javascript application/javascript application/json;
```

---

## 📊 Monitoring

### Log Monitoring

```bash
# View logs
tail -f storage/logs/laravel.log

# With filter
tail -f storage/logs/laravel.log | grep ERROR
```

### Uptime Monitoring

Consider using:
- UptimeRobot
- Pingdom
- StatusCake

### Application Monitoring

- Laravel Telescope (development)
- Laravel Horizon (if using queues)
- Sentry (error tracking)

---

## 🔄 Updates

### Pull Updates

```bash
cd /var/www/bmad-generator
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Zero-Downtime Deployment

Use tools like:
- Laravel Envoyer
- Deployer
- Capistrano

---

## 💾 Backup

### Automated Backup Script

```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/bmad-generator"

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/bmad-generator

# Backup database (if using MySQL)
# mysqldump -u user -p database > $BACKUP_DIR/db_$DATE.sql

# Keep only last 7 days
find $BACKUP_DIR -mtime +7 -delete
```

Schedule with cron:
```bash
0 2 * * * /path/to/backup.sh
```

---

## 🆘 Rollback

If something goes wrong:

```bash
# Git rollback
git reset --hard HEAD~1

# Restore from backup
cd /var/www
tar -xzf /backups/bmad-generator/files_DATE.tar.gz

# Clear caches
php artisan cache:clear
php artisan config:clear
```

---

## 📞 Support

Need help with deployment?
- Check [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
- Open an issue on GitHub
- Check Laravel documentation

---

**Good luck with your deployment! 🚀**
