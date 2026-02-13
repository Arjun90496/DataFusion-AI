# 🚀 DataFusion AI

**DataFusion AI** is a multi-tenant SaaS web application that allows users to securely connect external APIs, fuse data from multiple sources, and generate AI-powered insights through a premium dashboard.

---

## ✨ Features

### 🔐 Security
- Encrypted API key storage
- Backend-only API proxying
- CSRF protection
- Rate limiting (10 req/hour for fusion, 5 req/hour for AI)
- Security headers (X-Frame-Options, X-Content-Type-Options, etc.)
- User data isolation

### 🧠 AI Intelligence
- OpenAI GPT-powered insights
- Data summarization
- Trend detection
- Actionable recommendations
- Sentiment analysis

### 📊 Data Management
- Multi-source API integration (Weather, News, Crypto)
- Unified data fusion engine
- Historical data storage
- JSON-based flexible schema
- API response caching

### 📈 Monitoring & Logging
- Real-time activity dashboard
- API request logging
- Error tracking
- Performance metrics
- Response time monitoring

### 🎨 Premium UI/UX
- Modern glassmorphism design
- Dark theme with Tailwind CSS
- Responsive layout
- Intuitive navigation
- Real-time status indicators

---

## 🧱 Technology Stack

| Layer      | Technology                       |
|------------|--------------------------------- |
| Frontend   | HTML, Blade, Tailwind CSS        |
| Backend    | Laravel 11 (PHP 8.1+)            |
| Database   | MySQL 5.7+                       |
| AI         | OpenAI GPT-3.5 Turbo             |
| APIs       | OpenWeatherMap, NewsAPI, CoinGecko |

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- MySQL 5.7+
- Composer
- Node.js & npm

### Installation

```bash
# Clone repository
git clone https://github.com/yourusername/DataFusion-AI.git
cd DataFusion-AI

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Build assets
npm run dev

# Start server
php artisan serve
```

Visit `http://localhost:8000`

---

## 📚 Documentation

- **[Setup Guide](SETUP_GUIDE.md)** - Complete installation instructions
- **[Deployment Guide](DEPLOYMENT_GUIDE.md)** - Production deployment steps
- **[Production Checklist](PRODUCTION_CHECKLIST.md)** - Pre-deployment verification
- **[API Key Security](API_KEY_SECURITY_GUIDE.md)** - Security best practices
- **[Dashboard Guide](DASHBOARD_GUIDE.md)** - Feature walkthrough

---

## 🗂️ Project Structure

```
DataFusion-AI/
├── app/
│   ├── Http/Controllers/       # Request handlers
│   ├── Models/                 # Database models
│   ├── Services/
│   │   ├── ApiAdapters/        # API integration layer
│   │   ├── DataFusion/         # Data fusion engine
│   │   └── AI/                 # AI insight generation
│   └── Http/Middleware/        # Security & logging
├── database/migrations/        # Database schema
├── resources/views/            # Blade templates
├── routes/web.php              # Application routes
└── config/                     # Configuration files
```

---

## 🔑 Environment Variables

Required variables in `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_DATABASE=datafusion_ai
DB_USERNAME=your_user
DB_PASSWORD=your_password

OPENAI_API_KEY=sk-your-key
```

See [`.env.example`](.env.example) for complete configuration.

---

## 🎯 Usage

1. **Register Account** - Create your user account
2. **Add API Keys** - Configure Weather, News, and Crypto API keys
3. **Generate Fusion** - Combine data from all sources
4. **AI Insights** - Generate intelligent analysis
5. **Monitor Activity** - Track usage and performance

---

## 🧪 Development Phases

This project was developed in 9 phases:

1. **Authentication & Foundation** - User system and security
2. **Dashboard & API Keys** - Key management interface
3. **UI Enhancement** - Premium Tailwind design
4. **Database Schema** - Relational data modeling
5. **API Adapter System** - Multi-source integration
6. **Data Fusion Engine** - Unified data aggregation
7. **AI Insight Engine** - OpenAI-powered analysis
8. **Logging & Security** - Monitoring and hardening
9. **Deployment** - Production readiness

---

## 🔒 Security Features

- **Encryption**: API keys encrypted at rest using Laravel's Crypt
- **Rate Limiting**: Prevents abuse (10 fusion/hour, 5 AI/hour)
- **CSRF Protection**: All forms protected
- **Security Headers**: X-Frame-Options, X-Content-Type-Options, etc.
- **Input Validation**: All user inputs sanitized
- **User Isolation**: Strict data boundaries

---

## 📊 API Integrations

| API | Purpose | Rate Limit |
|-----|---------|------------|
| OpenWeatherMap | Weather data | 60 calls/min |
| NewsAPI | News articles | 100 calls/day |
| CoinGecko | Cryptocurrency prices | 50 calls/min |

---

## 🤝 Contributing

This is an academic project. For issues or suggestions, please open an issue.

---

## 📄 License

This project is developed for educational purposes.

---

## 🏁 Status

**Production Ready** ✅

All 9 development phases complete. Fully functional with comprehensive documentation.

---

**Built with ❤️ using Laravel, Tailwind CSS, and OpenAI**

