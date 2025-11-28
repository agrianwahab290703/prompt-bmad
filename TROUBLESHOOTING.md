# Troubleshooting Guide

Panduan ini membantu Anda mengatasi masalah umum yang mungkin terjadi saat menggunakan BMAD Generator.

## 🚨 Common Issues

### 1. "could not find driver" Error

**Problem**: SQLite driver tidak terinstall

**Solution**:
```bash
# Ubuntu/Debian
sudo apt-get install php-sqlite3

# macOS
brew install php-sqlite

# Restart web server setelah install
php artisan serve
```

**Verification**:
```bash
php -m | grep sqlite
# Should output: pdo_sqlite, sqlite3
```

---

### 2. "Failed to generate BMAD structure"

**Problem**: Issue dengan Z.AI API

**Possible Causes**:
1. API key tidak valid
2. API key belum di-set
3. Network issues
4. API rate limit exceeded

**Solutions**:

**A. Check API Key**
```bash
# Edit .env
nano .env

# Pastikan ada:
ZAI_API_KEY=your-actual-api-key-here
ZAI_API_URL=https://api.z.ai/v1
ZAI_MODEL=glm-4.6
```

**B. Test API Connection**
```bash
# Test dengan curl
curl -H "Authorization: Bearer YOUR_API_KEY" \
     https://api.z.ai/v1/models
```

**C. Check Logs**
```bash
tail -f storage/logs/laravel.log
```

---

### 3. Permission Denied Errors

**Problem**: Storage tidak writable

**Solution**:
```bash
# Set proper permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# If still issues, try:
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache

# For development:
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

---

### 4. ZIP Download Not Working

**Problem**: ZIP extension tidak aktif atau permission issue

**Solutions**:

**A. Check ZIP Extension**
```bash
php -m | grep zip
# Should output: zip
```

**B. Install ZIP Extension**
```bash
# Ubuntu/Debian
sudo apt-get install php-zip

# macOS
brew install php-zip
```

**C. Check Temp Directory**
```bash
mkdir -p storage/app/temp
chmod -R 775 storage/app/temp
```

---

### 5. "Session store not set" Error

**Problem**: Session configuration issue

**Solution**:
```bash
# Run migrations for session table
php artisan migrate

# Or use file-based sessions
# Edit .env
SESSION_DRIVER=file

# Clear cache
php artisan config:clear
php artisan cache:clear
```

---

### 6. "Class ZAIService not found"

**Problem**: Autoload issue

**Solution**:
```bash
composer dump-autoload

# If still issues:
composer install
php artisan optimize:clear
```

---

### 7. Slow Generation Time

**Problem**: API response lambat atau timeout

**Solutions**:

**A. Increase Timeout**
```env
# In .env
ZAI_TIMEOUT=120
```

**B. Check Network**
```bash
ping api.z.ai
```

**C. Optimize Prompt**
- Make prompt more specific
- Reduce scope jika terlalu besar
- Break into smaller generations

---

### 8. Invalid JSON Response

**Problem**: AI response tidak sesuai format

**Possible Causes**:
- Prompt terlalu complex
- AI model limitation
- Response truncated

**Solutions**:

**A. Simplify Prompt**
```
❌ Bad:
Buatkan full-stack e-commerce dengan 50+ fitur...

✅ Good:
Buatkan e-commerce sederhana dengan 5 fitur utama:
- Product listing
- Cart
- Checkout
- User auth
- Admin panel
```

**B. Check Max Tokens**
```php
// In ZAIService.php
'max_tokens' => 8192, // Increase if needed
```

**C. Handle Raw Response**
Aplikasi sudah handle ini - check `raw_response` key di preview.

---

### 9. "Composer not found"

**Problem**: Composer tidak terinstall

**Solution**:
```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Verify
composer --version
```

---

### 10. PHP Version Mismatch

**Problem**: PHP version < 8.3

**Solution**:
```bash
# Check version
php -v

# Ubuntu - Install PHP 8.3
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl

# Switch version
sudo update-alternatives --config php
```

---

## 🔍 Debugging Steps

### Enable Debug Mode

```env
# .env
APP_DEBUG=true
LOG_LEVEL=debug
```

### View Logs

```bash
# Real-time log viewing
tail -f storage/logs/laravel.log

# Search for errors
grep -i error storage/logs/laravel.log

# Last 100 lines
tail -n 100 storage/logs/laravel.log
```

### Clear All Caches

```bash
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Test Routes

```bash
php artisan route:list
```

### Test Database

```bash
php artisan tinker

>>> DB::connection()->getPdo();
// Should not throw error
```

---

## 🛠️ Development Issues

### Assets Not Loading

```bash
# Clear browser cache
# Hard refresh: Ctrl+Shift+R (Chrome/Firefox)

# Check public directory permissions
chmod -R 755 public
```

### Blade Compilation Issues

```bash
# Clear compiled views
php artisan view:clear

# Check views directory
ls -la resources/views/
```

### Service Provider Issues

```bash
# Re-discover packages
php artisan package:discover

# Optimize
php artisan optimize
```

---

## 📊 Performance Issues

### Slow Page Load

**Check**:
```bash
# Enable query log in tinker
php artisan tinker
>>> DB::enableQueryLog();
>>> // Run your code
>>> DB::getQueryLog();
```

**Solutions**:
- Enable opcache
- Use Redis for cache
- Optimize images
- Enable gzip compression

### Memory Issues

**Increase memory limit**:
```bash
# php.ini
memory_limit = 512M

# Or in code
ini_set('memory_limit', '512M');
```

---

## 🔐 Security Issues

### CSRF Token Mismatch

**Solution**:
```bash
# Clear session
php artisan session:flush

# Regenerate key
php artisan key:generate
```

### API Key Exposed

**Immediate Actions**:
1. Revoke old API key di Z.AI dashboard
2. Generate new API key
3. Update .env file
4. Never commit .env to git
5. Check .gitignore includes .env

---

## 🆘 Getting Help

### Before Asking for Help

1. ✅ Check this troubleshooting guide
2. ✅ Search existing issues on GitHub
3. ✅ Check Laravel documentation
4. ✅ Check Z.AI documentation
5. ✅ Try clearing all caches
6. ✅ Check logs for specific errors

### When Creating Issue

Include:
- PHP version: `php -v`
- Laravel version: `php artisan --version`
- OS: `uname -a` (Linux/Mac) or `ver` (Windows)
- Error message (full stack trace)
- Steps to reproduce
- What you've already tried

### Template:

```markdown
## Environment
- OS: Ubuntu 22.04
- PHP: 8.3.6
- Laravel: 12.40.2

## Problem
[Clear description]

## Steps to Reproduce
1. Go to...
2. Click on...
3. See error...

## Expected Behavior
[What should happen]

## Actual Behavior
[What actually happens]

## Error Logs
[Paste relevant logs]

## What I've Tried
- Cleared cache
- Checked permissions
- ...
```

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [PHP Manual](https://www.php.net/manual/en/)
- [Z.AI Documentation](https://z.ai/docs)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel)

---

**Still Having Issues?**

Open an issue on GitHub dengan detail lengkap, dan kami akan membantu Anda! 🚀
