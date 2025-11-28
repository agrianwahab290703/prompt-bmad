# Z.AI API Setup Guide

Panduan lengkap untuk mendapatkan dan mengonfigurasi Z.AI API untuk BMAD Generator.

## 📋 Prerequisites

- Email address untuk registrasi
- Payment method (jika diperlukan, tergantung plan)

## 🔑 Getting Started with Z.AI

### Step 1: Create Account

1. **Visit Z.AI Website**
   ```
   https://z.ai
   ```

2. **Sign Up**
   - Click "Sign Up" atau "Get Started"
   - Fill in your information:
     - Email address
     - Password
     - Name/Organization
   - Verify your email

3. **Complete Profile**
   - Add additional information if required
   - Choose your use case
   - Accept terms and conditions

### Step 2: Generate API Key

1. **Login to Dashboard**
   ```
   https://z.ai/dashboard
   atau
   https://platform.z.ai
   ```

2. **Navigate to API Keys**
   - Look for "API Keys", "Credentials", atau "Settings"
   - Usually in sidebar or top menu

3. **Create New API Key**
   - Click "Create API Key" atau "New Key"
   - Give it a name (e.g., "BMAD Generator - Production")
   - Select permissions:
     - ✅ Read access
     - ✅ Write access (untuk API calls)
   - Click "Generate" atau "Create"

4. **Copy API Key**
   ```
   ⚠️ IMPORTANT: Copy the key immediately!
   It will only be shown once.
   ```
   - Save it securely (password manager recommended)
   - Format usually: `zai_xxxxxxxxxxxxxxxxxxxxxxxx`

### Step 3: Test API Key

Test your API key with curl:

```bash
curl -X POST https://api.z.ai/v1/chat/completions \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "model": "glm-4.6",
    "messages": [
      {
        "role": "user",
        "content": "Hello, are you working?"
      }
    ]
  }'
```

Expected response:
```json
{
  "choices": [
    {
      "message": {
        "content": "Yes, I'm working correctly!"
      }
    }
  ]
}
```

## ⚙️ Configure BMAD Generator

### Option 1: Using .env File (Recommended)

1. **Edit .env file**
   ```bash
   nano .env
   ```

2. **Add Z.AI Configuration**
   ```env
   # Z.AI API Configuration
   ZAI_API_KEY=your_actual_api_key_here
   ZAI_API_URL=https://api.z.ai/v1
   ZAI_MODEL=glm-4.6
   ZAI_TIMEOUT=60
   ```

3. **Save and Exit**
   - Press `Ctrl + O` to save
   - Press `Ctrl + X` to exit

4. **Clear Config Cache**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

### Option 2: Using Environment Variables

```bash
export ZAI_API_KEY="your_actual_api_key_here"
export ZAI_API_URL="https://api.z.ai/v1"
export ZAI_MODEL="glm-4.6"
```

## 🔍 Verify Configuration

### Method 1: Via artisan tinker

```bash
php artisan tinker

>>> config('zai.api_key')
=> "zai_xxxxxxxxxxxxxxxxxxxxxxxx"

>>> config('zai.model')
=> "glm-4.6"
```

### Method 2: Test Generation

1. Start Laravel server:
   ```bash
   php artisan serve
   ```

2. Open browser: `http://localhost:8000`

3. Try simple prompt:
   ```
   Buatkan simple HTML page dengan heading "Hello World"
   ```

4. If successful, you'll see generated files!

## 🌐 API Endpoints

Z.AI provides various endpoints:

### Chat Completions (Main endpoint we use)
```
POST https://api.z.ai/v1/chat/completions
```

### Models List
```
GET https://api.z.ai/v1/models
```

### Account Info
```
GET https://api.z.ai/v1/account
```

## 💰 Pricing & Limits

(Note: Ini contoh, sesuaikan dengan actual Z.AI pricing)

### Free Tier
- 1,000 requests/month
- Rate limit: 10 requests/minute
- Model: glm-4.6
- Max tokens: 4,096

### Pro Tier
- 100,000 requests/month
- Rate limit: 100 requests/minute
- All models
- Max tokens: 8,192
- Priority support

### Enterprise
- Unlimited requests
- Custom rate limits
- Dedicated support
- Custom models
- SLA guarantee

## 📊 Monitoring Usage

### Via Z.AI Dashboard

1. Login to dashboard
2. Navigate to "Usage" atau "Analytics"
3. View:
   - Total requests
   - Tokens used
   - Costs
   - Rate limit status

### Via API

```bash
curl https://api.z.ai/v1/usage \
  -H "Authorization: Bearer YOUR_API_KEY"
```

## ⚠️ Best Practices

### 1. Security

```bash
# ✅ DO:
- Store API key in .env
- Add .env to .gitignore
- Use environment variables
- Rotate keys regularly

# ❌ DON'T:
- Commit API keys to git
- Share keys publicly
- Use same key for dev/prod
- Store keys in code
```

### 2. Rate Limiting

```php
// Implement rate limiting in your app
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/generate', [BMADController::class, 'generate']);
});
```

### 3. Error Handling

```php
try {
    $result = $zaiService->generateBMAD($prompt);
} catch (\Exception $e) {
    // Log error
    Log::error('Z.AI Error: ' . $e->getMessage());
    
    // Show user-friendly message
    return back()->with('error', 'Generation failed. Please try again.');
}
```

### 4. Timeout Configuration

```env
# Set appropriate timeout
ZAI_TIMEOUT=120  # 2 minutes for complex generations
```

### 5. Caching

```php
// Cache results to avoid duplicate API calls
$result = Cache::remember('bmad_' . md5($prompt), 3600, function() use ($prompt) {
    return $zaiService->generateBMAD($prompt);
});
```

## 🔧 Troubleshooting

### "Unauthorized" Error

**Problem**: API key invalid atau expired

**Solutions**:
1. Check API key di .env
2. Regenerate key di Z.AI dashboard
3. Clear config cache:
   ```bash
   php artisan config:clear
   ```

### "Rate Limit Exceeded"

**Problem**: Too many requests

**Solutions**:
1. Wait for rate limit to reset
2. Upgrade plan
3. Implement request queuing
4. Add delays between requests

### "Timeout" Error

**Problem**: Request taking too long

**Solutions**:
1. Increase timeout:
   ```env
   ZAI_TIMEOUT=180
   ```
2. Simplify prompt
3. Break into smaller requests

### "Invalid Model" Error

**Problem**: Model not available

**Solutions**:
1. Check available models:
   ```bash
   curl https://api.z.ai/v1/models \
     -H "Authorization: Bearer YOUR_API_KEY"
   ```
2. Use correct model name: `glm-4.6`
3. Check plan includes model

## 📚 Resources

### Official Documentation
- Z.AI Docs: https://z.ai/docs
- API Reference: https://z.ai/docs/api
- Model Guide: https://z.ai/docs/models
- Examples: https://z.ai/docs/examples

### Community
- Discord: https://discord.gg/zai (example)
- Forum: https://forum.z.ai (example)
- GitHub: https://github.com/zai (example)

### Support
- Email: support@z.ai
- Ticket System: https://z.ai/support
- Status Page: https://status.z.ai

## 🔄 API Key Rotation

Regularly rotate your API keys:

### Step 1: Generate New Key
1. Login to Z.AI dashboard
2. Create new API key
3. Copy new key

### Step 2: Update Configuration
```bash
# Update .env
nano .env
# Replace old key with new key
ZAI_API_KEY=new_key_here
```

### Step 3: Test
```bash
php artisan config:clear
# Test generation
```

### Step 4: Revoke Old Key
1. Go to Z.AI dashboard
2. Find old key
3. Click "Revoke" atau "Delete"

## 🎓 Examples

### Simple Test
```bash
curl -X POST https://api.z.ai/v1/chat/completions \
  -H "Authorization: Bearer $ZAI_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "model": "glm-4.6",
    "messages": [{
      "role": "user",
      "content": "Say hello"
    }]
  }'
```

### BMAD Generation Test
```bash
curl -X POST https://api.z.ai/v1/chat/completions \
  -H "Authorization: Bearer $ZAI_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "model": "glm-4.6",
    "messages": [{
      "role": "system",
      "content": "You are a code generator. Return valid JSON."
    }, {
      "role": "user",
      "content": "Generate a simple HTML file structure"
    }],
    "temperature": 0.7,
    "max_tokens": 1000
  }'
```

## ✅ Checklist

Before using BMAD Generator:

- [ ] Z.AI account created
- [ ] API key generated
- [ ] API key added to .env
- [ ] Config cache cleared
- [ ] API key tested with curl
- [ ] Test generation works
- [ ] Usage monitoring set up
- [ ] Rate limits understood
- [ ] Backup API key stored securely

---

**Ready to generate!** 🚀

Need help? Check [TROUBLESHOOTING.md](TROUBLESHOOTING.md) or open an issue.
