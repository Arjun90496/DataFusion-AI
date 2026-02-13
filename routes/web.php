<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\DataFusionController;
use App\Http\Controllers\AiInsightController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\SettingsController;

/**
 * Web Routes for DataFusion AI
 * 
 * BEGINNER EXPLANATION:
 * Routes connect URLs to Controllers. When a user visits a URL:
 * 1. Laravel checks this file to find a matching route
 * 2. Executes the specified controller method
 * 3. Returns the response to the browser
 * 
 * ROUTE STRUCTURE:
 * Route::method('url', [ControllerClass::class, 'methodName'])->name('route.name');
 * 
 * MIDDLEWARE EXPLAINED:
 * - Middleware = code that runs BEFORE the controller
 * - 'guest' middleware: only accessible when NOT logged in
 * - 'auth' middleware: only accessible when logged in
 */

/*
|--------------------------------------------------------------------------
| Welcome Page (Public)
|--------------------------------------------------------------------------
| 
| This is the home page that anyone can access.
| For now, it redirects to login. Later, you can create a landing page.
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Guest Routes (Only for NON-logged-in users)
|--------------------------------------------------------------------------
| 
| WHAT 'guest' MIDDLEWARE DOES:
| - Checks if user is logged in
| - If logged in → redirects to /dashboard
| - If NOT logged in → allows access
| 
| WHY USE 'guest'?
| - Prevents logged-in users from seeing login/register pages
| - User experience: if you're already logged in, why see the login page?
*/

// Registration Routes
Route::middleware('guest')->group(function () {
    // GET /register - Shows the registration form
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');
    
    // POST /register - Processes the registration form submission
    Route::post('/register', [RegisterController::class, 'register']);
});

// Login Routes
Route::middleware('guest')->group(function () {
    // GET /login - Shows the login form
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    
    // POST /login - Processes the login form submission
    Route::post('/login', [LoginController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Only for logged-in users)
|--------------------------------------------------------------------------
| 
| WHAT 'auth' MIDDLEWARE DOES:
| - Checks if user is logged in
| - If NOT logged in → redirects to /login
| - If logged in → allows access
| 
| HOW IT WORKS INTERNALLY:
| 1. User visits /dashboard
| 2. Auth middleware checks for session data
| 3. If session contains user ID:
|    - Laravel loads the User model from database
|    - Request proceeds to controller
| 4. If session is empty:
|    - User is redirected to /login
|    - Original URL (/dashboard) is saved
|    - After login, user is redirected back to /dashboard
*/

Route::middleware('auth')->group(function () {
    // GET /dashboard - Shows the user dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // POST /logout - Logs out the user
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
    
    // API Key Management Routes
    Route::get('/api-keys', [ApiKeyController::class, 'index'])->name('api-keys.index');
    Route::post('/api-keys', [ApiKeyController::class, 'store'])->name('api-keys.store');
    Route::get('/api-keys/{apiKey}/edit', [ApiKeyController::class, 'edit'])->name('api-keys.edit');
    Route::put('/api-keys/{apiKey}', [ApiKeyController::class, 'update'])->name('api-keys.update');
    Route::delete('/api-keys/{apiKey}', [ApiKeyController::class, 'destroy'])->name('api-keys.destroy');
    Route::post('/api-keys/{apiKey}/toggle', [ApiKeyController::class, 'toggle'])->name('api-keys.toggle');
    Route::get('/api-keys/{apiKey}/fetch', [ApiKeyController::class, 'fetchData'])->name('api-keys.fetch');
    
    // Data Fusion Routes (Relaxed for development: 100 per hour)
    Route::middleware('throttle:100,60')->group(function () {
        Route::post('/fusion/generate', [DataFusionController::class, 'generate'])->name('fusion.generate');
    });
    Route::get('/fusion', [DataFusionController::class, 'show'])->name('fusion.show');
    
    // AI Insights Routes (Relaxed for development: 100 per hour)
    Route::get('/insights', [AiInsightController::class, 'index'])->name('insights.index');
    Route::middleware('throttle:100,60')->group(function () {
        Route::post('/insights/generate', [AiInsightController::class, 'generate'])->name('insights.generate');
    });
    
    // Monitoring Routes
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

/*
|--------------------------------------------------------------------------
| HOW TO TEST YOUR ROUTES
|--------------------------------------------------------------------------
| 
| USING BROWSER:
| 1. Start Laravel server: php artisan serve
| 2. Visit http://localhost:8000
| 3. You should be redirected to /login
| 4. Try visiting /dashboard - you should be redirected to /login
| 5. Register a new account
| 6. After registration, you should see /dashboard
| 7. Close browser, reopen, visit /dashboard - should still be logged in
| 8. Click logout - should redirect to /login
| 9. Try visiting /register while logged in - should redirect to /dashboard
| 
| USING ARTISAN COMMAND:
| php artisan route:list
| - This shows all routes in your application
| - Check that all routes above are listed
| - Verify middleware is applied correctly
| 
|--------------------------------------------------------------------------
| ROUTE NAMING CONVENTIONS
|--------------------------------------------------------------------------
| 
| WHY NAME ROUTES?
| - Makes code more maintainable
| - If you change URL from /dashboard to /home, you only update it here
| - In controllers/views, you use route('dashboard') instead of '/dashboard'
| - If route doesn't exist, Laravel throws an error (catches typos)
| 
| EXAMPLES:
| - route('login') → /login
| - route('register') → /register
| - route('dashboard') → /dashboard
| - redirect()->route('dashboard') → redirects to /dashboard
| 
|--------------------------------------------------------------------------
| FUTURE ROUTE ADDITIONS
|--------------------------------------------------------------------------
| 
| As you build DataFusion AI, you'll add more routes here:
| 
| API Key Management:
| Route::get('/api-keys', [ApiKeyController::class, 'index'])->name('api-keys.index');
| Route::post('/api-keys', [ApiKeyController::class, 'store'])->name('api-keys.store');
| 
| Data Fusion:
| Route::get('/data-fusion', [DataFusionController::class, 'index'])->name('fusion.index');
| Route::post('/data-fusion/fetch', [DataFusionController::class, 'fetch'])->name('fusion.fetch');
| 
| AI Insights:
| Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
*/
