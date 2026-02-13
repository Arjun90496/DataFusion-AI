# DataFusion AI - Production Checklist

Use this checklist before deploying to production.

---

## Pre-Deployment

### Environment Configuration
- [ ] `.env` file created from `.env.example`
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` generated
- [ ] `APP_URL` set to production domain
- [ ] Database credentials configured
- [ ] `OPENAI_API_KEY` configured

### Security
- [ ] HTTPS enabled
- [ ] SSL certificate installed
- [ ] Strong database password
- [ ] File permissions set correctly (775 for storage)
- [ ] `.env` file not in version control
- [ ] Security headers configured

### Database
- [ ] Database created
- [ ] Migrations run successfully
- [ ] Database backups configured
- [ ] Database user has appropriate permissions

### Dependencies
- [ ] `composer install --no-dev` completed
- [ ] `npm run build` completed
- [ ] All dependencies up to date

---

## Deployment

### Server Configuration
- [ ] PHP 8.1+ installed
- [ ] MySQL/MariaDB installed
- [ ] Web server (Nginx/Apache) configured
- [ ] PHP extensions installed (pdo_mysql, openssl, mbstring, etc.)
- [ ] Correct document root set to `/public`

### Optimization
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] `composer dump-autoload --optimize`
- [ ] OPcache enabled

### File Permissions
- [ ] `chmod -R 775 storage`
- [ ] `chmod -R 775 bootstrap/cache`
- [ ] `chown -R www-data:www-data storage bootstrap/cache`

---

## Post-Deployment

### Testing
- [ ] Homepage loads correctly
- [ ] User registration works
- [ ] User login works
- [ ] API key management works
- [ ] Data fusion generation works
- [ ] AI insights generation works
- [ ] Monitoring dashboard accessible
- [ ] All routes return correct status codes

### Monitoring
- [ ] Error logging enabled
- [ ] `/monitoring` dashboard accessible
- [ ] API logs being recorded
- [ ] Rate limiting working

### Performance
- [ ] Page load times acceptable (<2s)
- [ ] Database queries optimized
- [ ] Assets loading correctly
- [ ] No console errors

---

## Ongoing Maintenance

### Daily
- [ ] Check monitoring dashboard
- [ ] Review error logs

### Weekly
- [ ] Database backup
- [ ] Check disk space
- [ ] Review API usage

### Monthly
- [ ] Update dependencies
- [ ] Security audit
- [ ] Performance review

---

## Rollback Plan

If deployment fails:

1. **Restore Database**:
   ```bash
   mysql -u username -p datafusion_ai < backup.sql
   ```

2. **Revert Code**:
   ```bash
   git checkout previous-stable-tag
   ```

3. **Clear Cache**:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

---

## Emergency Contacts

- **Server Admin**: [contact info]
- **Database Admin**: [contact info]
- **Developer**: [contact info]

---

**Last Updated**: 2024-02-09
