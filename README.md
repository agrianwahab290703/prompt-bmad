# BMAD Generator - Break My App Down

![Laravel](https://img.shields.io/badge/Laravel-11.x-red)
![PHP](https://img.shields.io/badge/PHP-8.3+-blue)
![License](https://img.shields.io/badge/license-MIT-green)

Website generator file BMAD (Break My App Down) yang menggunakan AI Z.AI dengan model glm-4.6 untuk membuat struktur project lengkap berdasarkan prompt pengguna.

## 🌟 Fitur

- **AI-Powered Generation**: Menggunakan Z.AI API dengan model glm-4.6 untuk analisis cerdas
- **BMAD Technique**: Memecah aplikasi menjadi komponen-komponen kecil dan terstruktur
- **Struktur File Lengkap**: Generate file struktur project yang terorganisir dengan baik
- **Preview Real-time**: Lihat preview struktur dan isi file sebelum download
- **Download ZIP**: Download seluruh project dalam format ZIP
- **User-Friendly Interface**: Antarmuka yang mudah digunakan dengan Tailwind CSS

## 🚀 Teknologi yang Digunakan

- **Framework**: Laravel 11.x
- **PHP Version**: 8.3+
- **AI API**: Z.AI (glm-4.6)
- **Frontend**: Tailwind CSS, Font Awesome
- **Database**: SQLite (default)

## 📋 Persyaratan Sistem

- PHP >= 8.3
- Composer
- SQLite extension enabled
- Z.AI API Key

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd bmad-generator
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Z.AI API

Edit file `.env` dan tambahkan API key Z.AI Anda:

```env
ZAI_API_KEY=your-zai-api-key-here
ZAI_API_URL=https://api.z.ai/v1
ZAI_MODEL=glm-4.6
```

### 5. Setup Database (Optional)

Jika ingin menyimpan history generation:

```bash
php artisan migrate
```

### 6. Setup Storage

```bash
mkdir -p storage/app/temp
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 7. Jalankan Server

```bash
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

## 🎯 Cara Penggunaan

### 1. Masukkan Prompt

Di halaman utama, masukkan deskripsi aplikasi yang ingin Anda buat. Contoh:

```
Buatkan saya aplikasi e-commerce sederhana dengan fitur:
- User authentication (login, register)
- Product catalog dengan kategori
- Shopping cart
- Checkout process
- Admin panel untuk manage products

Gunakan Node.js, Express, dan MongoDB
```

### 2. Generate Struktur

Klik tombol "Generate BMAD Structure" dan tunggu AI menganalisis prompt Anda.

### 3. Preview Hasil

Setelah generation selesai, Anda akan melihat:
- Struktur file tree di sidebar kiri
- Isi dari setiap file di panel kanan
- Tech stack yang digunakan
- Deskripsi project

### 4. Download Project

Klik tombol "Download ZIP" untuk mendownload seluruh project dalam format ZIP.

## 📁 Struktur Project

```
bmad-generator/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── BMADController.php    # Main controller
│   └── Services/
│       └── ZAIService.php            # Z.AI API service
├── config/
│   └── zai.php                       # Z.AI configuration
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php         # Main layout
│       └── bmad/
│           ├── index.blade.php       # Generator form
│           └── preview.blade.php     # Preview & download
├── routes/
│   └── web.php                       # Web routes
└── storage/
    └── app/
        └── temp/                      # Temporary generated files
```

## 🔑 Mendapatkan Z.AI API Key

1. Kunjungi [Z.AI](https://z.ai)
2. Daftar akun atau login
3. Buat API key baru
4. Copy API key ke file `.env`

## 🎨 Tips untuk Hasil Terbaik

- **Jelaskan fitur-fitur utama** yang diinginkan dengan detail
- **Sebutkan teknologi/framework** yang ingin digunakan
- **Berikan detail tentang struktur database** jika ada
- **Jelaskan user roles atau permissions** jika diperlukan
- Gunakan bahasa yang jelas dan spesifik

## 🛠️ Troubleshooting

### Error: "could not find driver"

Install SQLite extension:

```bash
sudo apt-get install php-sqlite3
```

### Error: "Failed to generate BMAD structure"

- Pastikan API key Z.AI sudah benar
- Check koneksi internet
- Lihat log di `storage/logs/laravel.log`

### Storage permission errors

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## 🤝 Kontribusi

Kontribusi selalu welcome! Silakan:

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail.

## 👥 Author

Dibuat dengan ❤️ menggunakan Laravel dan Z.AI

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Z.AI](https://z.ai) - AI API Provider
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Font Awesome](https://fontawesome.com) - Icons

## 📧 Support

Jika ada pertanyaan atau masalah, silakan buka issue di GitHub repository.

---

**Happy Coding!** 🚀
