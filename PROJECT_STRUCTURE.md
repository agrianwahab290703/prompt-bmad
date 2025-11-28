# Project Structure

Dokumentasi lengkap struktur project BMAD Generator.

## 📁 Directory Structure

```
bmad-generator/
├── app/                          # Application code
│   ├── Http/
│   │   └── Controllers/
│   │       └── BMADController.php    # Main controller untuk BMAD operations
│   ├── Services/
│   │   └── ZAIService.php            # Service untuk Z.AI API integration
│   ├── Models/                       # Eloquent models (if needed)
│   └── Providers/                    # Service providers
│
├── bootstrap/                    # Framework bootstrap files
│   └── cache/                    # Framework cache files
│
├── config/                       # Configuration files
│   ├── app.php                   # Application config
│   ├── zai.php                   # Z.AI API configuration
│   └── ...                       # Other configs
│
├── database/                     # Database related files
│   ├── migrations/               # Database migrations
│   └── database.sqlite           # SQLite database
│
├── docs/                         # Additional documentation
│   ├── API_INTEGRATION.md        # Z.AI API integration guide
│   └── BMAD_TECHNIQUE.md         # BMAD methodology explanation
│
├── public/                       # Public web root
│   └── index.php                 # Application entry point
│
├── resources/                    # Raw assets and views
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php     # Main layout template
│       └── bmad/
│           ├── index.blade.php   # Generator form page
│           └── preview.blade.php # Preview & download page
│
├── routes/                       # Route definitions
│   └── web.php                   # Web routes
│
├── storage/                      # Storage for logs, cache, uploads
│   ├── app/
│   │   └── temp/                 # Temporary generated files
│   ├── framework/
│   └── logs/
│       └── laravel.log           # Application logs
│
├── tests/                        # Automated tests
│   ├── Feature/                  # Feature tests
│   └── Unit/                     # Unit tests
│
├── vendor/                       # Composer dependencies
│
├── .env                          # Environment variables (not in git)
├── .env.example                  # Environment template
├── .gitignore                    # Git ignore rules
├── artisan                       # Artisan CLI
├── composer.json                 # PHP dependencies
├── composer.lock                 # Locked dependencies
│
├── CHANGELOG.md                  # Version history
├── CONTRIBUTING.md               # Contribution guidelines
├── DEPLOYMENT.md                 # Deployment guide
├── EXAMPLES.md                   # Example prompts
├── LICENSE                       # MIT License
├── PROJECT_STRUCTURE.md          # This file
├── QUICKSTART.md                 # Quick start guide
├── README.md                     # Main documentation
└── TROUBLESHOOTING.md            # Troubleshooting guide
```

## 🔑 Key Files Explained

### Application Core

#### `app/Http/Controllers/BMADController.php`
Main controller yang handle:
- `index()` - Menampilkan form generator
- `generate()` - Generate BMAD structure dari prompt
- `preview()` - Preview hasil generation
- `download()` - Download project sebagai ZIP
- `refine()` - Refine/improve individual files

#### `app/Services/ZAIService.php`
Service layer untuk Z.AI API:
- `generateBMAD()` - Call Z.AI API untuk generate struktur
- `refineFile()` - Call Z.AI API untuk refine file
- Error handling dan response parsing

#### `config/zai.php`
Konfigurasi Z.AI API:
- API key
- API URL
- Model (glm-4.6)
- Timeout settings

### Views

#### `resources/views/layouts/app.blade.php`
Layout template utama dengan:
- Navigation bar
- Success/error messages
- Footer
- Tailwind CSS styling

#### `resources/views/bmad/index.blade.php`
Halaman generator dengan:
- Form input prompt
- Tips untuk user
- Feature showcase

#### `resources/views/bmad/preview.blade.php`
Halaman preview dengan:
- File tree visualization
- Code viewer dengan syntax highlighting
- Copy to clipboard functionality
- Download button

### Routes

#### `routes/web.php`
Route definitions:
- `GET /` - Generator form
- `POST /generate` - Process generation
- `GET /preview` - Preview results
- `GET /download` - Download ZIP
- `POST /refine` - Refine file (API)

### Configuration

#### `.env`
Environment variables:
```env
APP_NAME=Laravel
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

ZAI_API_KEY=your-api-key
ZAI_API_URL=https://api.z.ai/v1
ZAI_MODEL=glm-4.6

DB_CONNECTION=sqlite
```

## 🔄 Request Flow

### Generate Request Flow

```
User Input (Prompt)
    ↓
BMADController@generate
    ↓
ZAIService@generateBMAD
    ↓
Z.AI API Call
    ↓
Response Processing
    ↓
Store in Session
    ↓
Redirect to Preview
    ↓
BMADController@preview
    ↓
Display Results
```

### Download Flow

```
Download Button Click
    ↓
BMADController@download
    ↓
Get Session Data
    ↓
Create Temp Directory
    ↓
Generate Files
    ↓
Create ZIP Archive
    ↓
Send Download Response
    ↓
Cleanup Temp Files
```

## 📦 Dependencies

### Main Dependencies (composer.json)

```json
{
    "require": {
        "php": "^8.3",
        "laravel/framework": "^12.0",
        "guzzlehttp/guzzle": "^7.2"
    }
}
```

### Frontend Dependencies

- **Tailwind CSS**: Styling framework (via CDN)
- **Font Awesome**: Icons (via CDN)
- **Vanilla JavaScript**: Interactive features

## 🗂️ Data Flow

### Session Data Structure

```php
[
    'bmad_data' => [
        'project_name' => 'nama-project',
        'description' => 'Deskripsi project',
        'tech_stack' => ['React', 'Node.js', 'MongoDB'],
        'files' => [
            [
                'path' => 'src/index.js',
                'description' => 'Entry point',
                'content' => '// Code here...'
            ],
            // ... more files
        ]
    ]
]
```

### Z.AI API Request

```json
{
    "model": "glm-4.6",
    "messages": [
        {
            "role": "system",
            "content": "System prompt..."
        },
        {
            "role": "user",
            "content": "User prompt..."
        }
    ],
    "temperature": 0.7,
    "max_tokens": 4096
}
```

### Z.AI API Response

```json
{
    "choices": [
        {
            "message": {
                "content": "{\"project_name\":\"...\", \"files\":[...]}"
            }
        }
    ]
}
```

## 🔒 Security Features

### Built-in Protection

- **CSRF Protection**: All POST requests protected
- **Input Validation**: Form validation dengan Laravel rules
- **XSS Protection**: Blade templating auto-escape
- **SQL Injection**: Eloquent ORM protection
- **Session Security**: Secure session handling

### Environment Security

- `.env` not in git (via `.gitignore`)
- API keys stored in environment variables
- Production mode disables debug info

## 🎨 Styling Architecture

### Tailwind CSS Classes

Utility-first approach:
- Responsive design
- Consistent spacing
- Color palette
- Custom components

### Custom Styles

Minimal custom CSS untuk:
- Code blocks
- File tree visualization
- Hover effects

## 🧪 Testing Structure

```
tests/
├── Feature/
│   ├── BMADGenerationTest.php    # Test generation flow
│   └── FileDownloadTest.php      # Test download functionality
└── Unit/
    └── ZAIServiceTest.php         # Test API service
```

## 📝 Logging

### Log Locations

- Application logs: `storage/logs/laravel.log`
- Error logs: Logged automatically
- API errors: Logged in ZAIService

### Log Levels

- `debug`: Development information
- `info`: General information
- `warning`: Warning conditions
- `error`: Error conditions
- `critical`: Critical conditions

## 🔧 Maintenance

### Regular Tasks

1. **Clear Logs**
   ```bash
   rm storage/logs/*.log
   ```

2. **Clear Temp Files**
   ```bash
   rm -rf storage/app/temp/*
   ```

3. **Clear Cache**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

4. **Update Dependencies**
   ```bash
   composer update
   ```

## 📊 Performance Considerations

### Optimization Points

1. **Config Caching**: Cache configuration files
2. **Route Caching**: Cache routes
3. **View Caching**: Pre-compile Blade templates
4. **Composer Autoloader**: Optimize class map
5. **OPcache**: Enable PHP OPcache

### Monitoring

- Log file size
- Temp directory size
- Session storage
- API response times

## 🌟 Extension Points

### Easy to Extend

1. **New AI Providers**: Add new service classes
2. **Additional Features**: Add methods to controller
3. **Custom Templates**: Add pre-defined templates
4. **Export Formats**: Add new export options
5. **User System**: Add authentication
6. **Database Storage**: Store generation history

## 📚 Documentation Files

### For Users
- `README.md` - Main documentation
- `QUICKSTART.md` - Quick setup guide
- `EXAMPLES.md` - Example prompts
- `TROUBLESHOOTING.md` - Problem solving

### For Developers
- `CONTRIBUTING.md` - How to contribute
- `DEPLOYMENT.md` - Deployment instructions
- `PROJECT_STRUCTURE.md` - This file
- `docs/API_INTEGRATION.md` - API details
- `docs/BMAD_TECHNIQUE.md` - Methodology

### Legal & Changes
- `LICENSE` - MIT License
- `CHANGELOG.md` - Version history

---

**This structure is designed to be:**
- ✅ Easy to understand
- ✅ Easy to extend
- ✅ Easy to maintain
- ✅ Production-ready

For questions about structure, check documentation or open an issue on GitHub.
