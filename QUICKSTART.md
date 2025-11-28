# Quick Start Guide

Panduan cepat untuk memulai menggunakan BMAD Generator dalam 5 menit!

## ⚡ Quick Installation

### Prerequisites
- PHP 8.3+
- Composer
- Git

### 1. Install & Setup (2 menit)

```bash
# Clone repository
git clone <your-repo-url>
cd bmad-generator

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup storage
mkdir -p storage/app/temp
chmod -R 775 storage
```

### 2. Configure Z.AI API Key (30 detik)

Edit file `.env`:
```env
ZAI_API_KEY=paste-your-api-key-here
```

**Belum punya API key?**
1. Daftar di [Z.AI](https://z.ai)
2. Generate API key
3. Copy ke `.env`

### 3. Run Application (10 detik)

```bash
php artisan serve
```

Buka browser: `http://localhost:8000`

## 🎯 First Generation (2 menit)

### Step 1: Masukkan Prompt

Paste prompt ini di form:

```
Buatkan aplikasi To-Do List sederhana dengan:
- Add new task
- Mark task as complete
- Delete task
- Filter (All, Active, Completed)

Tech stack: HTML, CSS, JavaScript (Vanilla)
```

### Step 2: Generate

Klik tombol **"Generate BMAD Structure"** dan tunggu 10-20 detik.

### Step 3: Preview & Download

- Lihat struktur file yang di-generate
- Klik file untuk melihat isinya
- Klik **"Download ZIP"** untuk download project

## 🚀 Next Steps

### Try Different Prompts

**Simple Web App:**
```
Buatkan landing page untuk startup dengan:
- Hero section
- Features section
- Pricing
- Contact form
Tech: React + Tailwind CSS
```

**API Backend:**
```
Buatkan REST API untuk blog dengan:
- User authentication
- CRUD posts
- Comments
- Categories
Tech: Node.js + Express + MongoDB
```

**Full Stack:**
```
Buatkan aplikasi note-taking dengan:
- User auth
- Create/edit/delete notes
- Categories
- Search
- Markdown support
Tech: Vue.js + Laravel + MySQL
```

## 💡 Tips untuk Prompt yang Baik

✅ **DO:**
- Sebutkan fitur-fitur spesifik
- Tentukan tech stack
- Jelaskan use case
- Berikan context yang jelas

❌ **DON'T:**
- Prompt terlalu umum ("buatkan website")
- Terlalu banyak fitur sekaligus (50+ features)
- Tidak jelas teknologinya
- Requirement yang bertentangan

## 🔧 Troubleshooting Cepat

### Error: "Failed to generate"
```bash
# Check API key
cat .env | grep ZAI_API_KEY

# Check logs
tail storage/logs/laravel.log
```

### Error: "Permission denied"
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: "could not find driver"
```bash
# Install SQLite
sudo apt-get install php-sqlite3
```

## 📚 Learn More

- [README.md](README.md) - Dokumentasi lengkap
- [EXAMPLES.md](EXAMPLES.md) - Lebih banyak contoh
- [BMAD_TECHNIQUE.md](docs/BMAD_TECHNIQUE.md) - Pelajari teknik BMAD
- [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Panduan troubleshooting

## 🎓 Best Practices

### 1. Start Small
Mulai dengan project sederhana dulu untuk memahami output yang dihasilkan.

### 2. Iterate
Jika hasil kurang sesuai, refine prompt dan generate ulang.

### 3. Review Code
Selalu review code yang di-generate sebelum digunakan di production.

### 4. Customize
Gunakan hasil generation sebagai starting point, lalu customize sesuai kebutuhan.

## 🌟 Example Workflow

1. **Brainstorm**: Tentukan fitur-fitur yang dibutuhkan
2. **Draft Prompt**: Tulis prompt dengan jelas
3. **Generate**: Generate struktur dengan BMAD
4. **Review**: Periksa file-file yang di-generate
5. **Download**: Download dan extract
6. **Customize**: Sesuaikan dengan kebutuhan spesifik
7. **Develop**: Lanjutkan development
8. **Test**: Test aplikasi
9. **Deploy**: Deploy ke production

## 🎉 Success!

Selamat! Anda sudah berhasil menggunakan BMAD Generator.

**Next Challenge:**
Try generating a more complex application dengan multiple features!

---

Need help? Check [TROUBLESHOOTING.md](TROUBLESHOOTING.md) atau buka issue di GitHub.

**Happy Generating! 🚀**
