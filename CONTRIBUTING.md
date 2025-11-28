# Contributing to BMAD Generator

Terima kasih atas minat Anda untuk berkontribusi pada BMAD Generator! 

## 🤝 Cara Berkontribusi

### Melaporkan Bug

Jika Anda menemukan bug:

1. Cek dulu di [Issues](https://github.com/your-repo/issues) apakah bug sudah dilaporkan
2. Jika belum, buat issue baru dengan label `bug`
3. Sertakan:
   - Deskripsi bug yang jelas
   - Langkah untuk reproduce
   - Expected behavior vs actual behavior
   - Screenshot jika perlu
   - Environment details (OS, PHP version, etc)

### Mengajukan Fitur Baru

1. Buat issue dengan label `enhancement`
2. Jelaskan fitur yang diinginkan
3. Jelaskan use case dan benefit
4. Tunggu diskusi dengan maintainer

### Pull Request Process

1. **Fork** repository ini
2. **Clone** fork Anda
   ```bash
   git clone https://github.com/your-username/bmad-generator.git
   ```
3. **Create branch** untuk fitur Anda
   ```bash
   git checkout -b feature/amazing-feature
   ```
4. **Make changes** dengan mengikuti coding standards
5. **Test** perubahan Anda
6. **Commit** dengan pesan yang jelas
   ```bash
   git commit -m "feat: add amazing feature"
   ```
7. **Push** ke fork Anda
   ```bash
   git push origin feature/amazing-feature
   ```
8. **Open Pull Request** ke branch `main`

## 📝 Coding Standards

### PHP/Laravel

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style
- Use type hints
- Add docblocks untuk public methods
- Keep methods small and focused
- Use dependency injection

```php
<?php

namespace App\Services;

/**
 * Service untuk handle AI operations
 */
class AIService
{
    /**
     * Generate content menggunakan AI
     *
     * @param string $prompt User prompt
     * @return array Response dari AI
     */
    public function generate(string $prompt): array
    {
        // Implementation
    }
}
```

### Blade Templates

- Use kebab-case untuk file names
- Indent dengan 4 spaces
- Keep logic minimal di views
- Use components untuk reusable UI

```blade
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        
        @foreach($items as $item)
            <x-card :item="$item" />
        @endforeach
    </div>
@endsection
```

### JavaScript

- Use modern ES6+ syntax
- Add comments untuk complex logic
- Keep functions small

```javascript
// Good
const showFile = (index) => {
    hideAllFiles();
    document.getElementById(`file-${index}`).classList.remove('hidden');
};

// Bad
function showFile(index) {
    var elements = document.querySelectorAll('.file-content');
    for(var i = 0; i < elements.length; i++) {
        elements[i].style.display = 'none';
    }
    document.getElementById('file-' + index).style.display = 'block';
}
```

## 🧪 Testing

Sebelum submit PR, pastikan:

1. **Syntax Check**
   ```bash
   php -l app/Services/YourService.php
   ```

2. **Code Style** (jika tersedia)
   ```bash
   ./vendor/bin/pint
   ```

3. **Run Tests** (jika tersedia)
   ```bash
   php artisan test
   ```

4. **Manual Testing**
   - Test fitur yang Anda ubah
   - Test edge cases
   - Test error handling

## 📋 Commit Message Convention

Gunakan [Conventional Commits](https://www.conventionalcommits.org/):

```
<type>: <description>

[optional body]

[optional footer]
```

### Types:

- `feat`: Fitur baru
- `fix`: Bug fix
- `docs`: Dokumentasi
- `style`: Format, missing semicolons, etc
- `refactor`: Refactoring code
- `test`: Adding tests
- `chore`: Maintenance tasks

### Examples:

```
feat: add export to CSV functionality

Add ability to export generated files to CSV format.
Includes new ExportService and route.

Closes #123
```

```
fix: resolve memory leak in file generation

The temporary files were not being cleaned up properly.
Added cleanup in destructor and after download.
```

```
docs: update API integration guide

Add examples for error handling and retry logic.
```

## 🏗️ Project Structure

```
bmad-generator/
├── app/
│   ├── Http/
│   │   └── Controllers/     # Request handlers
│   ├── Services/           # Business logic
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── config/                # Configuration files
├── resources/
│   └── views/            # Blade templates
├── routes/               # Route definitions
├── tests/                # Tests
└── docs/                 # Additional documentation
```

## 🎯 Areas yang Membutuhkan Kontribusi

- [ ] Unit tests
- [ ] Integration tests
- [ ] API documentation
- [ ] Internationalization (i18n)
- [ ] Performance optimization
- [ ] UI/UX improvements
- [ ] Additional AI providers support
- [ ] Template library
- [ ] CLI version

## 💡 Tips untuk Kontributor

1. **Start Small**: Mulai dari issue yang labeled `good first issue`
2. **Ask Questions**: Jangan ragu bertanya di issue atau discussions
3. **Read Code**: Pelajari codebase yang ada sebelum membuat perubahan besar
4. **Be Patient**: Review membutuhkan waktu
5. **Stay Updated**: Pull latest changes sebelum mulai coding

## 📞 Komunikasi

- **Issues**: Untuk bug reports dan feature requests
- **Discussions**: Untuk pertanyaan dan diskusi umum
- **Pull Requests**: Untuk code contributions

## 🙏 Recognition

Contributors akan disebutkan di:
- README.md
- CHANGELOG.md
- Release notes

## 📜 License

Dengan berkontribusi, Anda setuju bahwa kontribusi Anda akan dilisensikan di bawah MIT License yang sama dengan project ini.

---

**Terima kasih atas kontribusi Anda!** 🎉
