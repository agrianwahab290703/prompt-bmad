# Security Policy

## Supported Versions

Berikut adalah versi yang currently supported dengan security updates:

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |

## Reporting a Vulnerability

Keamanan adalah prioritas kami. Jika Anda menemukan vulnerability dalam BMAD Generator, mohon laporkan dengan responsible disclosure.

### How to Report

**DO NOT** create public GitHub issue untuk security vulnerabilities.

Instead, please email to: **security@yourdomain.com** (replace with actual email)

Include the following information:

1. **Type of vulnerability**
   - e.g., XSS, CSRF, SQL Injection, etc.

2. **Full paths of source file(s) related to the vulnerability**

3. **Location of the affected source code**
   - Tag/branch/commit or direct URL

4. **Step-by-step instructions to reproduce the issue**

5. **Proof-of-concept or exploit code** (if possible)

6. **Impact of the issue**
   - What an attacker could do with this vulnerability

### What to Expect

1. **Acknowledgment**: We will acknowledge your email within 48 hours

2. **Investigation**: We'll investigate and validate the vulnerability

3. **Fix Development**: We'll work on a fix

4. **Coordinated Disclosure**: 
   - We'll coordinate with you for public disclosure
   - Typically 90 days after initial report

5. **Credit**: We'll credit you in release notes (unless you prefer to remain anonymous)

## Security Best Practices

### For Developers

#### 1. Environment Variables
```bash
# Never commit .env file
# Always use .env.example as template
# Keep sensitive data in environment variables
```

#### 2. API Keys
```bash
# Rotate API keys regularly
# Use different keys for dev/staging/production
# Revoke old keys immediately after rotation
```

#### 3. Input Validation
```php
// Always validate user input
$request->validate([
    'prompt' => 'required|string|min:10|max:5000',
]);
```

#### 4. XSS Prevention
```blade
{{-- Use Blade's {{ }} for auto-escaping --}}
{{ $userInput }}

{{-- Only use {!! !!} when absolutely necessary --}}
{{!! $trustedContent !!}}
```

#### 5. CSRF Protection
```blade
{{-- Always include CSRF token in forms --}}
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

### For Users

#### 1. API Key Security
- **Never share** your Z.AI API key
- **Never commit** API keys to version control
- **Rotate keys** if compromised
- **Use environment variables** for keys

#### 2. Server Security
```bash
# Keep software updated
sudo apt update && sudo apt upgrade

# Use firewall
sudo ufw enable
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Disable root login
# Edit /etc/ssh/sshd_config
PermitRootLogin no
```

#### 3. File Permissions
```bash
# Correct permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache
```

#### 4. HTTPS
```bash
# Always use HTTPS in production
# Get free SSL with Let's Encrypt
sudo certbot --nginx -d yourdomain.com
```

#### 5. Regular Backups
```bash
# Backup regularly
# Store backups securely
# Test restore procedures
```

## Known Security Considerations

### 1. AI Generated Code
- **Review all generated code** before use
- AI can generate insecure code patterns
- Always validate and sanitize inputs
- Test security before deployment

### 2. Temporary Files
- Files stored in `storage/app/temp/`
- Automatically cleaned after download
- Ensure proper permissions
- Monitor disk space

### 3. Session Storage
- Generation data stored in sessions
- Sessions expire after configured time
- Use secure session drivers in production

### 4. Rate Limiting
Consider implementing rate limiting:
```php
// In routes/web.php
Route::middleware(['throttle:10,1'])->group(function () {
    Route::post('/generate', ...);
});
```

### 5. API Timeout
- Prevent long-running requests
- Configure appropriate timeout
- Handle timeouts gracefully

## Security Checklist for Production

- [ ] `APP_ENV=production` in `.env`
- [ ] `APP_DEBUG=false` in `.env`
- [ ] HTTPS enabled with valid certificate
- [ ] File permissions correctly set
- [ ] `.env` file not publicly accessible
- [ ] Firewall configured
- [ ] Regular security updates applied
- [ ] Backups configured
- [ ] Monitoring and logging enabled
- [ ] Rate limiting implemented
- [ ] API keys rotated regularly
- [ ] Error pages don't leak information

## Vulnerability Disclosure Timeline

Typical timeline for vulnerability handling:

- **Day 0**: Vulnerability reported
- **Day 1-2**: Acknowledge receipt
- **Day 3-7**: Validate and reproduce
- **Day 8-30**: Develop and test fix
- **Day 30-90**: Coordinate disclosure
- **Day 90**: Public disclosure (if not fixed earlier)

## Security Updates

Security updates will be released as:
- Patch releases (e.g., 1.0.1)
- Documented in CHANGELOG.md
- Announced via GitHub releases

Subscribe to releases to get notified:
https://github.com/yourusername/bmad-generator/releases

## Hall of Fame

We appreciate security researchers who help us keep BMAD Generator secure:

<!-- List of security researchers will be added here -->

## Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security](https://laravel.com/docs/security)
- [PHP Security Guide](https://phptherightway.com/#security)

## Contact

For security concerns: security@yourdomain.com
For general questions: Check [TROUBLESHOOTING.md](TROUBLESHOOTING.md)

---

**Remember**: Security is everyone's responsibility. Stay vigilant and report any concerns.
