# DataFusion AI - Setup Guide

## Prerequisites

Before running DataFusion AI, ensure you have:

1. **PHP** (version 8.1 or higher)
2. **Composer** (PHP package manager)
3. **Node.js & npm** (for frontend assets)
4. **MySQL** (database server)
5. **Git** (version control)

---

## Step-by-Step Setup Instructions

### 1. Install Dependencies

#### Option A: If Composer and npm are in PATH

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

#### Option B: If you get "command not found" errors

**For PowerShell Execution Policy Error (npm):**
```powershell
# Run PowerShell as Administrator and execute:
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser

# Then try again:
npm install
```

**For Composer not found:**
- Download from: https://getcomposer.org/download/
- Add to Windows PATH
- Restart terminal

**For npm not found:**
- Download Node.js from: https://nodejs.org/
- Restart terminal after installation

---

### 2. Configure Database

#### Create MySQL Database

Open MySQL command line or phpMyAdmin and run:

```sql
CREATE DATABASE datafusion_ai CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Update .env File

The `.env` file has been created with these settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=datafusion_ai
DB_USERNAME=root
DB_PASSWORD=
```

**If your MySQL has a password**, edit `.env` and set:
```env
DB_PASSWORD=your_mysql_password
```

---

### 3. Run Database Migrations

This will create all tables (users, api_providers, api_keys, etc.):

```bash
php artisan migrate
```

**If you get errors:**
- Check MySQL is running
- Verify database credentials in `.env`
- Make sure `datafusion_ai` database exists

---

### 4. Seed API Providers

Populate the database with default API providers:

```bash
php artisan db:seed --class=ApiProviderSeeder
```

This adds:
- OpenWeatherMap
- NewsAPI
- OpenAI
- GitHub API

---

### 5. Start Development Servers

You need **TWO terminal windows**:

#### Terminal 1: Laravel Backend Server

```bash
php artisan serve
```

**Output:**
```
Laravel development server started: http://127.0.0.1:8000
```

Leave this running!

#### Terminal 2: Frontend Asset Server (if using Vite)

```bash
npm run dev
```

**Output:**
```
VITE v4.x.x  ready in xxx ms

➜  Local:   http://localhost:5173/
```

Leave this running!

---

### 6. Access the Application

Open your browser and navigate to:

```
http://localhost:8000
```

**Landing Page:** http://localhost:8000  
**Login:** http://localhost:8000/login  
**Register:** http://localhost:8000/register  
**Dashboard:** http://localhost:8000/dashboard (after login)  
**API Keys:** http://localhost:8000/api-keys (after login)  

---

## Quick Command Reference

```bash
# Start Laravel server
php artisan serve

# Start frontend dev server
npm run dev

# Run migrations
php artisan migrate

# Fresh migration (⚠️ deletes all data)
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Create new user manually
php artisan tinker
>>> User::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => bcrypt('password')]);

# Check routes
php artisan route:list

# Clear cache
php artisan cache:clear
php artisan config:clear
```

---

## Troubleshooting

### "Base table or view not found"
**Solution:** Run migrations
```bash
php artisan migrate
```

### "SQLSTATE[HY000] [1045] Access denied"
**Solution:** Check MySQL credentials in `.env`

### "Class 'ApiProviderSeeder' not found"
**Solution:** Run composer autoload
```bash
composer dump-autoload
php artisan db:seed --class=ApiProviderSeeder
```

### "npm: command not found"
**Solution:** Install Node.js from https://nodejs.org/

### "composer: command not found"
**Solution:** Install Composer from https://getcomposer.org/

### PowerShell Script Execution Error
**Solution:**
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

---

## First-Time User Flow

1. **Register Account**: http://localhost:8000/register
   - Enter name, email, password
   - Click "Create Account"

2. **View Dashboard**: Auto-redirected to dashboard
   - See stats (currently showing sample data)
   - View sample API cards

3. **Add API Key**: Click "API Keys" in sidebar
   - Click "+ Add API Key"
   - Select provider (e.g., OpenWeatherMap)
   - Enter nickname: "My Weather API"
   - Enter API key: `your-actual-api-key`
   - Click "Save Key"

4. **Verify Encryption**:
   - Open MySQL: `SELECT * FROM api_keys;`
   - Check `encrypted_key` column shows encrypted data (not plain text)

5. **Test Toggle**:
   - Enable/disable keys using toggle switch
   - Delete keys with confirmation modal

---

## Project Structure

```
DataFusion-AI/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   └── RegisterController.php
│   │   ├── DashboardController.php
│   │   └── ApiKeyController.php          # Phase 4
│   └── Models/
│       ├── User.php
│       ├── ApiProvider.php                # Phase 4
│       └── ApiKey.php                     # Phase 4 (with encryption)
├── database/
│   ├── migrations/
│   │   ├── 2024_01_30_000001_create_users_table.php
│   │   ├── 2024_01_30_000002_create_api_providers_table.php
│   │   └── 2024_01_30_000003_create_api_keys_table.php
│   └── seeders/
│       └── ApiProviderSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── layout.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── welcome.blade.php
│       ├── dashboard.blade.php
│       └── api-keys/
│           └── index.blade.php             # Phase 4
├── routes/
│   └── web.php
├── .env                                    # Database config
├── composer.json                           # PHP dependencies
└── package.json                            # JS dependencies
```

---

## What's Implemented (Phase 4 Complete)

✅ **Authentication**: Login, Register, Logout  
✅ **Dashboard**: Stats, API cards, AI insights, activity timeline  
✅ **API Key Management**: Add, edit, delete, enable/disable  
✅ **Encryption**: AES-256-CBC for API keys  
✅ **Security**: User isolation, masked display, authorization  
✅ **Premium Dark UI**: Glassmorphism, gradients, animations  

---

## Next Development Phases

- **Phase 5**: Data Fetching Engine (use stored API keys)
- **Phase 6**: Data Fusion Engine (combine multiple APIs)
- **Phase 7**: AI Insight Engine (generate recommendations)

---

## Need Help?

1. Check `API_KEY_SECURITY_GUIDE.md` for encryption details
2. Check `DASHBOARD_GUIDE.md` for dashboard architecture
3. Check `TAILWIND_DARK_THEME_GUIDE.md` for styling patterns
4. Run `php artisan route:list` to see all available routes
5. Check browser console for frontend errors
6. Check `storage/logs/laravel.log` for backend errors

---

**Happy Coding! 🚀**
