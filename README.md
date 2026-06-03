# Website TPS 3R Kelurahan Wates X Sirsak

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

Website management dan tracking system untuk **TPS 3R (Tempat Pengolahan Sampah 3 Regrouping) Kelurahan Wates** sebagai agregator dalam ekosistem **PT Sirkular Saka Indonesia (Sirsak)**.

## 📋 Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Struktur Organisasi](#struktur-organisasi)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

---

## 🎯 Tentang Proyek

Website TPS 3R Kelurahan Wates adalah sistem manajemen terintegrasi yang dirancang untuk mengelola dan melacak aktivitas pengumpulan, pemrosesan, dan distribusi sampah dari **25 Bank Sampah Unit (Waste Collection Centers)** yang tersebar di Kelurahan Wates.

Proyek ini dibuat sebagai bagian dari **branding dan sistem operasional PT Sirkular Saka Indonesia**, dengan fokus pada:
- 📦 Manajemen inventory sampah
- 📊 Tracking dan monitoring real-time
- 🏢 Koordinasi dengan 25 unit pengumpulan sampah
- 📈 Pelaporan dan analisis data
- 🔗 Integrasi dengan sistem Sirsak yang lebih besar

### Konteks Bisnis

```
PT Sirkular Saka Indonesia (Sirsak)
    └── TPS 3R Kelurahan Wates (Agregator)
            ├── Bank Sampah Unit 1
            ├── Bank Sampah Unit 2
            ├── Bank Sampah Unit 3
            ...
            └── Bank Sampah Unit 25
```

---

## ✨ Fitur Utama

### 1. Dashboard & Analytics
- 📊 Overview jumlah sampah yang dikumpulkan per unit
- 📈 Grafik trend pengumpulan sampah
- 💾 Total inventory sampah saat ini
- 🎯 KPI monitoring dan target pencapaian

### 2. Manajemen Bank Sampah Unit
- 📝 Register dan data 25 bank sampah unit
- 📍 Lokasi geografis setiap unit
- 👥 Informasi ketua dan kontak unit
- 📊 Statistik per unit (berat sampah, jenis material, dll)

### 3. Tracking Sampah
- 📦 Input penimbangan sampah dari setiap unit
- 🔄 Tracking alur sampah: Unit → Agregator → Recycler
- 📋 History transaksi dan movement sampah
- ⏰ Timestamp dan audit trail lengkap

### 4. Inventory Management
- 📊 Real-time inventory status
- 📌 Jenis material (PET, MLP, Cardboard, Metal, HDPE, dll)
- ⚖️ Tracking berat dan volume
- 💰 Valuation berdasarkan harga pasar

### 5. Reporting
- 📄 Laporan bulanan/tahunan
- 📊 Export data ke Excel/PDF
- 📈 Grafik dan visualisasi data
- 🎯 Performance vs target

### 6. Integrasi Sirsak
- 🔗 API connection dengan sistem utama Sirsak
- 🔐 Authentication dan authorization
- 📡 Data synchronization
- 🌐 Branding konsisten Sirsak

---

## 🏗️ Struktur Organisasi

### TPS 3R Wates - Agregator Role

```
TPS 3R Kelurahan Wates (Agregator)
├── Input Penimbangan Sampah
│   └── Dari 25 Bank Sampah Unit
│
├── Inventory Management
│   ├── Penerimaan dari BSU
│   ├── Storage & Processing
│   └── Pengiriman ke Recycler
│
├── Quality Control
│   ├── Sorting & Grading
│   ├── Weight Verification
│   └── Material Categorization
│
├── Reporting & Analytics
│   ├── Daily Collection Reports
│   ├── Monthly Summaries
│   └── Performance Metrics
│
└── Coordination
    ├── 25 Bank Sampah Units
    └── Recycler Partners
```

---

## 🛠️ Tech Stack

| Layer | Technology | Purpose |
|-------|-----------|---------|
| **Backend** | Laravel 11 | Web framework, API, Database ORM |
| **Frontend** | Blade Template | Server-side rendering |
| **Styling** | Bootstrap 5, Tailwind CSS | UI/UX framework |
| **JavaScript** | Vanilla JS, Alpine.js | Interactivity |
| **Database** | MySQL/PostgreSQL | Data storage |
| **Build Tool** | Vite | Asset bundling |
| **Testing** | PHPUnit | Unit testing |
| **Code Quality** | PSR-12 | PHP standards |

### Dependencies

**Utama:**
- Laravel Framework 11.x
- Eloquent ORM
- Blade Templating Engine
- Laravel Query Builder

**Frontend:**
- Bootstrap 5.x
- Tailwind CSS 3.x
- Alpine.js
- Chart.js (untuk grafik)

**Utility:**
- Composer (PHP package manager)
- NPM (Node package manager)
- Vite (modern build tool)

---

## 📦 Requirements

### Minimum System Requirements

- **PHP:** 8.2 atau lebih tinggi
- **Composer:** 2.0 atau lebih tinggi
- **Node.js:** 18.x atau lebih tinggi
- **npm:** 9.x atau lebih tinggi
- **Database:** MySQL 8.0+ atau PostgreSQL 13+
- **Web Server:** Apache 2.4+ atau Nginx

### Development Tools

```bash
# Wajib
- Git
- Composer
- Node.js & npm
- Text Editor (VS Code, PhpStorm, dll)

# Optional
- Docker (untuk development environment)
- Postman (untuk API testing)
- DBeaver (untuk database management)
```

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/Jackdesign1/website-tps-3r-kelurahan-wates-x-sirsak.git
cd website-tps-3r-kelurahan-wates-x-sirsak
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Setup Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Database Setup

```bash
# Run migrations
php artisan migrate

# Optional: Seed database with sample data
php artisan db:seed
```

### 7. Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Start Development Server

```bash
# Terminal 1: Backend (Laravel)
php artisan serve

# Terminal 2: Frontend (Vite - optional)
npm run dev
```

Application akan accessible di `http://localhost:8000`

---

## ⚙️ Configuration

### `.env` Configuration

```env
# APP
APP_NAME="TPS 3R Wates"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# DATABASE
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tps3r_wates
DB_USERNAME=root
DB_PASSWORD=

# SIRSAK INTEGRATION
SIRSAK_API_URL=https://api.sirsak.id
SIRSAK_API_KEY=your_api_key_here
SIRSAK_AGGREGATOR_ID=wates

# MAIL (optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password

# CACHE & SESSION
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Database Setup

```bash
# Create database
mysql -u root -e "CREATE DATABASE tps3r_wates CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php artisan migrate

# Seed initial data
php artisan db:seed --class=BankSampahSeeder
```

---

## 📖 Usage

### Untuk Admin/Operator TPS 3R

#### 1. Login
```
URL: http://localhost:8000/login
Default: admin@tps3r-wates.id / password
```

#### 2. Input Penimbangan Sampah
```
Menu: Admin Panel → Input Penimbangan BSU
- Pilih Bank Sampah Unit (dari 25 unit)
- Input tanggal penimbangan
- Pilih jenis material (PET, MLP, Cardboard, Metal, HDPE)
- Input berat sampah
- Input harga per kg
- [Simpan] → Otomatis masuk inventory Agregator
```

#### 3. Lihat Inventory Agregator
```
Menu: Agregator → View Inventory
- Pilih Agregator (Wates)
- Lihat inventory cards per material
- Klik material untuk kirim ke Recycler
- Isi form: tanggal, berat, recycler tujuan
```

#### 4. View Penerimaan Recycler
```
Menu: Recycler → Penerimaan (View Only)
- Filter berdasarkan Tahun & Bulan
- Lihat summary total per recycler
- View detail penerimaan dari agregator
```

### Untuk Development

#### Development Workflow

```bash
# 1. Start development server
php artisan serve

# 2. Watch assets changes
npm run dev

# 3. Run tests
php artisan test

# 4. Generate API documentation
php artisan scribe:generate
```

#### Common Artisan Commands

```bash
# Database
php artisan migrate                    # Run migrations
php artisan migrate:rollback          # Rollback last migration
php artisan db:seed                   # Run seeders
php artisan tinker                    # Interactive shell

# Cache & Optimization
php artisan cache:clear               # Clear all cache
php artisan config:cache              # Cache configuration
php artisan route:cache               # Cache routes

# Code Quality
php artisan tinker                    # Debug
vendor/bin/phpunit                    # Run tests
```

---

## 📁 Project Structure

```
website-tps-3r-kelurahan-wates-x-sirsak/
│
├── app/                              # Application code
│   ├── Http/
│   │   ├── Controllers/              # Request handlers
│   │   ├── Middleware/               # Request middleware
│   │   └── Requests/                 # Form validation
│   ├── Models/                       # Database models (Eloquent)
│   │   ├── BankSampahUnit.php        # Bank Sampah Unit
│   │   ├── Aggregator.php            # Agregator
│   │   ├── Recycler.php              # Recycler
│   │   ├── Material.php              # Material types
│   │   ├── Penimbangan.php           # Weighing records
│   │   └── User.php                  # Users
│   ├── Services/                     # Business logic
│   └── Policies/                     # Authorization
│
├── bootstrap/                        # Bootstrap framework
│   ├── app.php
│   └── cache/
│
├── config/                           # Configuration files
│   ├── app.php
│   ├── database.php
│   ├── mail.php
│   └── services.php
│
├── database/
│   ├── migrations/                   # Database migrations
│   │   ├── create_users_table.php
│   │   ├── create_bank_sampah_units_table.php
│   │   ├── create_aggregators_table.php
│   │   ├── create_recyclers_table.php
│   │   ├── create_materials_table.php
│   │   └── create_penimbangans_table.php
│   ├── seeders/                      # Database seeders
│   │   ├── DatabaseSeeder.php
│   │   ├── BankSampahSeeder.php
│   │   ├── AggregatorSeeder.php
│   │   └── RecyclerSeeder.php
│   └── factories/                    # Model factories
│
├── public/                           # Web server root
│   ├── index.php                     # Entry point
│   ├── css/                          # Compiled styles
│   ├── js/                           # Compiled scripts
│   └── images/
│       ├── logo_sirsak.png
│       └── logo_wates.png
│
├── resources/
│   ├── views/                        # Blade templates
│   │   ├── layouts/                  # Layout templates
│   │   ├── components/               # Reusable components
│   │   ├── dashboard.blade.php
│   │   ├── admin/
│   │   │   ├── penimbangan.blade.php
│   │   │   ├── agregator.blade.php
│   │   │   └── recycler.blade.php
│   │   └── auth/                     # Authentication views
│   ├── css/                          # Source stylesheets
│   │   ├── app.css
│   │   └── tailwind.css
│   └── js/                           # Source JavaScript
│       ├── app.js
│       └── components/
│
├── routes/
│   ├── web.php                       # Web routes
│   ├── api.php                       # API routes
│   └── auth.php                      # Auth routes
│
├── storage/
│   ├── app/                          # Application file storage
│   ├── logs/                         # Application logs
│   └── framework/
│
├── tests/                            # Test files
│   ├── Feature/                      # Feature tests
│   │   ├── PenimbanganTest.php
│   │   ├── AggregatorTest.php
│   │   └── RecyclerTest.php
│   └── Unit/                         # Unit tests
│
├── .env.example                      # Environment template
├── .gitignore                        # Git ignore rules
├── composer.json                     # PHP dependencies
├── composer.lock                     # Locked PHP versions
├── package.json                      # Node dependencies
├── package-lock.json                 # Locked Node versions
├── vite.config.js                    # Vite configuration
├── phpunit.xml                       # PHPUnit configuration
├── artisan                           # Laravel CLI
└── README.md                         # This file
```

---

## 📊 Database Schema Overview

### Key Tables

```sql
-- Bank Sampah Units (Waste Collection Centers)
bank_sampah_units
├── id, name, address, village, district, regency
├── ketua_name, ketua_phone
├── aggregator_id (FK)
└── created_at, updated_at

-- Aggregators
aggregators
├── id, name, address, location
├── manager_name, manager_phone
└── created_at, updated_at

-- Recyclers
recyclers
├── id, name, address, material_type
├── capacity_per_day
└── created_at, updated_at

-- Materials
materials
├── id, name (PET, MLP, Cardboard, Metal, HDPE)
├── price_per_kg, color_code
└── created_at, updated_at

-- Penimbangan (Weighing Records)
penimbangans
├── id, bsu_id (FK), tanggal
├── material_id (FK), berat_kg, harga_per_kg
├── total_value
└── created_at, updated_at

-- Pengiriman (Shipments)
pengirimen
├── id, aggregator_id (FK)
├── tanggal, material_id (FK)
├── berat_kg, recycler_id (FK)
└── created_at, updated_at
```

---

## 🧪 Testing

### Run Tests

```bash
# All tests
php artisan test

# Specific test file
php artisan test tests/Feature/PenimbanganTest.php

# With coverage
php artisan test --coverage
```

### Test Examples

```php
// tests/Feature/PenimbanganTest.php
class PenimbanganTest extends TestCase
{
    public function test_penimbangan_dapat_disimpan()
    {
        $response = $this->post('/admin/penimbangan', [
            'bsu_id' => 1,
            'tanggal' => now(),
            'material_id' => 1,
            'berat_kg' => 50,
            'harga_per_kg' => 400
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('penimbangans', ['bsu_id' => 1]);
    }
}
```

---

## 📈 Performance & Optimization

### Caching Strategy

```php
// Cache inventory aggregator selama 1 jam
$inventory = Cache::remember('aggregator_inventory', 3600, function () {
    return Aggregator::with('materials')->first();
});
```

### Query Optimization

```php
// Use eager loading
$penimbangans = Penimbangan::with(['bsuUnit', 'material'])->get();

// Use select specific columns
$units = BankSampahUnit::select(['id', 'name', 'address'])->get();
```

---

## 🔐 Security

### Important Security Notes

```env
# .env
APP_DEBUG=false              # Never true in production
APP_KEY=base64:...           # Generate secure key

# Database credentials
DB_PASSWORD=strong_password  # Use strong passwords

# API Keys
SIRSAK_API_KEY=...          # Keep secret
```

### Authentication

- Password hashing: bcrypt
- Session management: Secure cookies
- CSRF protection: Laravel middleware
- Authorization: Policies & Gates

---

## 📝 Contributing

### Git Workflow

```bash
# 1. Create feature branch
git checkout -b feature/nama-fitur

# 2. Make changes
# ... edit files ...

# 3. Commit
git commit -m "Add: deskripsi perubahan"

# 4. Push
git push origin feature/nama-fitur

# 5. Create Pull Request
```

### Code Standards

- PSR-12 PHP coding standard
- Blade template best practices
- Meaningful variable/function names
- Comments for complex logic

---

## 🤝 Collaboration

### Tim Development

| Role | Tanggung Jawab |
|------|---|
| Backend Developer | Laravel, API, Database |
| Frontend Developer | Blade templates, CSS, JavaScript |
| Database Admin | Schema design, migrations, optimization |
| QA Engineer | Testing, bug reports, documentation |
| DevOps | Deployment, server management, monitoring |

---

## 📞 Contact & Support

- **Perusahaan:** PT Sirkular Saka Indonesia (Sirsak)
- **Project:** Website TPS 3R Kelurahan Wates
- **Documentation:** Lihat repository wiki
- **Issues:** Gunakan GitHub Issues untuk bug reports
- **Email:** dev@sirsak.id (contoh)

---

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- PT Sirkular Saka Indonesia (Sirsak) - Perusahaan induk
- Kelurahan Wates - Lokasi operasional
- 25 Bank Sampah Unit - Partner lapangan
- Laravel Community - Framework & tools

---

**Last Updated:** June 2026  
**Version:** 1.0.0  
**Status:** Active Development

---

## Quick Links

- 📘 [Laravel Documentation](https://laravel.com/docs)
- 🎨 [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- 📊 [Chart.js Documentation](https://www.chartjs.org/docs/latest/)
- 🗄️ [MySQL Documentation](https://dev.mysql.com/doc/)

---

*Dibuat dengan ❤️ untuk mendukung ekonomi sirkular dan pengelolaan sampah berkelanjutan di Kelurahan Wates.*
