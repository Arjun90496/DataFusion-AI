# DataFusion AI - Deployment Guide

## 🚀 Quick Start Deployment

This guide will help you deploy DataFusion AI to production.

---

## Prerequisites

- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Node.js & npm (for frontend assets)
- Web server (Apache/Nginx)
- SSL certificate (for HTTPS)

---

## Step-by-Step Deployment

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/DataFusion-AI.git
cd DataFusion-AI
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies
npm install
npm run build
```

### 3. Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure `.env` File

Edit `.env` and set the following:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=datafusion_ai
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

OPENAI_API_KEY=sk-your-openai-key
```

> ⚠️ **CRITICAL**: Set `APP_DEBUG=false` in production!

### 5. Run Database Migrations

```bash
php artisan migrate --force
```

### 6. Set File Permissions

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 7. Optimize for Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 8. Configure Web Server

#### Nginx Configuration

```nginx
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name your-domain.com;
    root /var/www/DataFusion-AI/public;

    ssl_certificate /path/to/ssl/cert.pem;
    ssl_certificate_key /path/to/ssl/key.pem;

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
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### Apache Configuration

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    Redirect permanent / https://your-domain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName your-domain.com
    DocumentRoot /var/www/DataFusion-AI/public

    SSLEngine on
    SSLCertificateFile /path/to/ssl/cert.pem
    SSLCertificateKeyFile /path/to/ssl/key.pem

    <Directory /var/www/DataFusion-AI/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 9. Enable HTTPS

```bash
# Using Let's Encrypt
sudo certbot --nginx -d your-domain.com
```

### 10. Verify Deployment

Visit `https://your-domain.com` and:
- ✅ Register a new account
- ✅ Add API keys
- ✅ Generate fusion data
- ✅ Generate AI insights
- ✅ Check monitoring dashboard

---

## Common Issues & Solutions

### Issue: "500 Internal Server Error"

**Solution**: Check file permissions
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: "APP_KEY not set"

**Solution**: Generate application key
```bash
php artisan key:generate
```

### Issue: Database connection failed

**Solution**: Verify database credentials in `.env`

### Issue: "Class not found"

**Solution**: Clear and rebuild cache
```bash
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```

### Issue: Assets not loading

**Solution**: Rebuild frontend assets
```bash
npm run build
```

---

## Production Best Practices

### Security

- ✅ Set `APP_DEBUG=false`
- ✅ Use strong `APP_KEY`
- ✅ Enable HTTPS
- ✅ Use environment variables for secrets
- ✅ Keep dependencies updated
- ✅ Regular security audits

### Performance

- ✅ Enable OPcache
- ✅ Use Redis for cache/sessions
- ✅ Enable Gzip compression
- ✅ Use CDN for static assets
- ✅ Database indexing
- ✅ Query optimization

### Monitoring

- ✅ Check `/monitoring` dashboard daily
- ✅ Set up error alerts
- ✅ Monitor API usage
- ✅ Track response times
- ✅ Review error logs

### Backups

```bash
# Database backup
mysqldump -u username -p datafusion_ai > backup.sql

# Full backup
tar -czf backup.tar.gz /var/www/DataFusion-AI
```

---

## Maintenance

### Update Application

```bash
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Environment Variables Reference

| Variable | Description | Required |
|----------|-------------|----------|
| `APP_ENV` | Environment (production/local) | Yes |
| `APP_DEBUG` | Debug mode (false in production) | Yes |
| `APP_KEY` | Encryption key | Yes |
| `APP_URL` | Application URL | Yes |
| `DB_*` | Database credentials | Yes |
| `OPENAI_API_KEY` | OpenAI API key for insights | Yes |
| `CACHE_DRIVER` | Cache driver (redis recommended) | No |
| `SESSION_DRIVER` | Session driver (redis recommended) | No |

---

## Support

For issues or questions:
- Check `/monitoring` for error logs
- Review Laravel logs in `storage/logs/`
- Consult documentation

---

**🎉 Congratulations! DataFusion AI is now deployed!**
