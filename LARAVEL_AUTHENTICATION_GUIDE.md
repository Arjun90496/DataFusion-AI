# Laravel Authentication Explained for Beginners

This document explains how Laravel's authentication system works internally, perfect for complete beginners who want to understand what's happening behind the scenes.

---

## Table of Contents

1. [How Password Hashing Works](#how-password-hashing-works)
2. [How Sessions Work](#how-sessions-work)
3. [How Middleware Works](#how-middleware-works)
4  [How Remember Me Works](#how-remember-me-works)
5. [Complete Authentication Flow](#complete-authentication-flow)
6. [Security Best Practices](#security-best-practices)

---

## How Password Hashing Works

### What is Hashing?

**Hashing** is a one-way encryption process. Once you hash a password, you can NEVER reverse it back to the original password.

### Why Hash Passwords?

If your database gets hacked, attackers will only see hashed passwords, not the real passwords. This protects your users.

### How Laravel Hashes Passwords

Laravel uses an algorithm called **bcrypt**:

```
Original password: "mypassword123"
↓ (bcrypt hashing)
Hashed password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
```

**IMPORTANT**: Even if two users have the same password, their hashes will be DIFFERENT because bcrypt adds random "salt" to each hash.

### How Login Verification Works

When a user logs in:

1. User enters email and password
2. Laravel finds the user by email in the database
3. Laravel hashes the entered password
4. Laravel compares the NEW hash with the STORED hash
5. If they match → login successful
6. If they don't match → login failed

**Code in Laravel:**

```php
// When registering
$user = User::create([
    'password' => Hash::make('mypassword123')  // Hashes the password
]);

// When logging in
if (Hash::check('mypassword123', $user->password)) {
    // Password is correct!
}
```

---

## How Sessions Work

### What is a Session?

A **session** is a way for the server to "remember" who you are across multiple page visits.

### The Problem Sessions Solve

HTTP is "stateless" - the server doesn't remember you between requests:

```
You visit page 1 → Server: "Who are you?"
You visit page 2 → Server: "Who are you?" (forgot you!)
You visit page 3 → Server: "Who are you?" (forgot you again!)
```

Sessions fix this by storing your information on the server and giving you a unique ID.

### How Laravel Sessions Work

#### Step 1: Login

```
┌─────────────┐                  ┌─────────────┐
│   Browser   │     POST /login  │   Laravel   │
│             │─────────────────>│   Server    │
│             │   email+password │             │
│             │                  │  1. Verify  │
│             │                  │     password│
│             │                  │  2. Create  │
│             │                  │     session │
│             │                  │     file:   │
│             │                  │     sess_abc│
│             │                  │  3. Store   │
│             │                  │     user ID │
│             │<─────────────────│  4. Send    │
│  Stores     │   Cookie:        │     cookie  │
│  SessionID  │   PHPSESSID=abc  │             │
│  in cookie  │                  │             │
└─────────────┘                  └─────────────┘
```

#### Step 2: Subsequent Requests

```
┌─────────────┐                  ┌─────────────┐
│   Browser   │   GET /dashboard │   Laravel   │
│             │─────────────────>│   Server    │
│  Sends      │   Cookie:        │             │
│  SessionID  │   PHPSESSID=abc  │  1. Read    │
│  cookie     │                  │     cookie  │
│             │                  │  2. Open    │
│             │                  │     sess_abc│
│             │                  │  3. Get     │
│             │                  │     user ID │
│             │                  │  4. Load    │
│             │                  │     user    │
│             │<─────────────────│  5. Return  │
│             │   Dashboard      │     page    │
│             │   page           │             │
└─────────────┘                  └─────────────┘
```

### Session Storage

Laravel stores sessions in files (by default) in the `storage/framework/sessions` folder:

```
storage/framework/sessions/
├── sess_abc123...
├── sess_def456...
└── sess_ghi789...
```

Each session file contains:
```
user_id: 1
_token: csrf_token_here
_flash: any flash messages
```

### Session Lifetime

- **Default**: Sessions last 2 hours (120 minutes)
- **After browser close**: Session cookie is deleted (unless "Remember Me" is checked)
- **After logout**: Session file is deleted from server

---

## How Middleware Works

### What is Middleware?

**Middleware** is code that runs BEFORE your controller. Think of it as a "checkpoint" or "gatekeeper" for routes.

### Visual Representation

```
User visits URL
     ↓
[Middleware] ← Checkpoint #1: Check if logged in?
     ↓
     ├─ If YES → Allow access to Controller
     └─ If NO  → Redirect to login page
```

### Laravel's Auth Middleware

Located in: `app/Http/Middleware/Authenticate.php`

**What it does:**

1. Checks if the session contains a user ID
2. If yes → user is authenticated, allow access
3. If no → user is a guest, redirect to `/login`

### Example in Routes

```php
// This route is PROTECTED by auth middleware
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth');

// If user is NOT logged in:
// 1. Middleware detects no session
// 2. Middleware redirects to /login
// 3. Controller is NEVER reached
```

### Guest Middleware

The opposite of `auth` middleware:

```php
// This route is only for GUESTS (non-logged-in users)
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->middleware('guest');

// If user IS logged in:
// 1. Middleware detects session exists
// 2. Middleware redirects to /dashboard
// 3. Controller is NEVER reached
```

### Middleware Execution Order

```
Request
  ↓
1. Global Middleware (runs on every request)
  ↓
2. Route Middleware (e.g., 'auth' or 'guest')
  ↓
3. Controller
  ↓
Response
```

---

## How Remember Me Works

### The Problem

Normal sessions expire when you close the browser. "Remember Me" lets users stay logged in even after closing the browser.

### How It Works

#### 1. When User Checks "Remember Me"

```php
Auth::attempt($credentials, $request->boolean('remember'));
//                         ↑
//                    This is TRUE if checkbox was checked
```

Laravel does the following:

1. Generates a random token (e.g., `Xy9k3jF8mL2p...`)
2. Stores token in database (`users.remember_token` column)
3. Stores token in browser cookie (expires in 5 years!)

#### 2. When User Returns (Browser Closed and Reopened)

```
┌─────────────┐                  ┌─────────────┐
│   Browser   │   GET /dashboard │   Laravel   │
│             │─────────────────>│   Server    │
│  Sends      │   Cookie:        │             │
│  remember   │   remember_abc   │  1. Session │
│  token      │                  │     expired │
│             │                  │  2. Check   │
│             │                  │     remember│
│             │                  │     cookie  │
│             │                  │  3. Find    │
│             │                  │     user    │
│             │                  │     with    │
│             │                  │     token   │
│             │                  │  4. Login   │
│             │                  │     user    │
│             │<─────────────────│  5. Create  │
│             │   Dashboard      │     new     │
│             │   page           │     session │
└─────────────┘                  └─────────────┘
```

#### 3. Database Storage

The `users` table has a `remember_token` column:

```
+----+------+------------------+-------------------------------+
| id | name | email            | remember_token                |
+----+------+------------------+-------------------------------+
| 1  | John | john@example.com | Xy9k3jF8mL2p1qR5vN7tK9m...    |
+----+------+------------------+-------------------------------+
```

#### 4. Security

- Token is random and unpredictable
- Token changes every time you logout and login again with "Remember Me"
- Even if database is leaked, attacker needs BOTH user ID AND token

---

## Complete Authentication Flow

### Registration Flow

```
Step 1: User Visits /register
┌──────────────────────────────────────┐
│ Browser shows registration form      │
└──────────────────────────────────────┘
                ↓
Step 2: User Fills Form and Submits
┌──────────────────────────────────────┐
│ POST /register                       │
│ {name, email, password, password_    │
│  confirmation}                       │
└──────────────────────────────────────┘
                ↓
Step 3: Laravel Validates Input
┌──────────────────────────────────────┐
│ Check if email is valid              │
│ Check if password is at least 8 chars│
│ Check if passwords match             │
│ Check if email is unique in database │
└──────────────────────────────────────┘
        ↓               ↓
    VALID           INVALID
        ↓               ↓
        │      Redirect back with errors
        │
Step 4: Create User in Database
┌──────────────────────────────────────┐
│ Hash password using bcrypt           │
│ INSERT INTO users                    │
│ (name, email, password)              │
└──────────────────────────────────────┘
                ↓
Step 5: Auto-Login User
┌──────────────────────────────────────┐
│ Create session file                  │
│ Store user ID in session             │
│ Send session cookie to browser       │
└──────────────────────────────────────┘
                ↓
Step 6: Redirect to Dashboard
┌──────────────────────────────────────┐
│ User sees dashboard                  │
└──────────────────────────────────────┘
```

### Login Flow

```
Step 1: User Visits /login
┌──────────────────────────────────────┐
│ Browser shows login form             │
└──────────────────────────────────────┘
                ↓
Step 2: User Enters Credentials
┌──────────────────────────────────────┐
│ POST /login                          │
│ {email, password, remember}          │
└──────────────────────────────────────┘
                ↓
Step 3: Find User in Database
┌──────────────────────────────────────┐
│ SELECT * FROM users                  │
│ WHERE email = 'entered_email'        │
└──────────────────────────────────────┘
        ↓               ↓
    FOUND         NOT FOUND
        ↓               ↓
        │         Return error
        │
Step 4: Verify Password
┌──────────────────────────────────────┐
│ Hash entered password                │
│ Compare with stored hash             │
└──────────────────────────────────────┘
        ↓               ↓
    MATCH         NO MATCH
        ↓               ↓
        │         Return error
        │
Step 5: Create Session
┌──────────────────────────────────────┐
│ Generate session ID                  │
│ Create session file                  │
│ Store user ID in session             │
│ Regenerate session ID (security)     │
└──────────────────────────────────────┘
                ↓
Step 6: If "Remember Me" Checked
┌──────────────────────────────────────┐
│ Generate random token                │
│ Store token in database              │
│ Send long-lived cookie to browser    │
└──────────────────────────────────────┘
                ↓
Step 7: Redirect to Dashboard
┌──────────────────────────────────────┐
│ User sees dashboard                  │
└──────────────────────────────────────┘
```

### Protected Page Access Flow

```
Step 1: User Visits /dashboard
┌──────────────────────────────────────┐
│ GET /dashboard                       │
└──────────────────────────────────────┘
                ↓
Step 2: Auth Middleware Checks Session
┌──────────────────────────────────────┐
│ Does cookie contain session ID?      │
│ Does session file exist?             │
│ Does session contain user_id?        │
└──────────────────────────────────────┘
        ↓               ↓
    YES (logged in) NO (guest)
        ↓               ↓
        │         Redirect to /login
        │
Step 3: Load User from Database
┌──────────────────────────────────────┐
│ SELECT * FROM users                  │
│ WHERE id = session['user_id']        │
└──────────────────────────────────────┘
                ↓
Step 4: Execute Controller
┌──────────────────────────────────────┐
│ DashboardController@index            │
│ Get user data                        │
│ Return dashboard view                │
└──────────────────────────────────────┘
                ↓
Step 5: Render View
┌──────────────────────────────────────┐
│ Display dashboard with user info     │
└──────────────────────────────────────┘
```

### Logout Flow

```
Step 1: User Clicks Logout Button
┌──────────────────────────────────────┐
│ POST /logout                         │
└──────────────────────────────────────┘
                ↓
Step 2: Remove User from Session
┌──────────────────────────────────────┐
│ Auth::logout()                       │
│ Removes user_id from session         │
└──────────────────────────────────────┘
                ↓
Step 3: Invalidate Session
┌──────────────────────────────────────┐
│ Delete session file from server      │
│ Delete session cookie from browser   │
└──────────────────────────────────────┘
                ↓
Step 4: Regenerate CSRF Token
┌──────────────────────────────────────┐
│ Create new CSRF token                │
│ (Security: prevents old forms from   │
│  being submitted)                    │
└──────────────────────────────────────┘
                ↓
Step 5: Redirect to Login
┌──────────────────────────────────────┐
│ User sees login page                 │
└──────────────────────────────────────┘
```

---

## Security Best Practices

### 1. Password Hashing

✅ **DO:**
```php
Hash::make($password)  // Uses bcrypt
```

❌ **DON'T:**
```php
md5($password)  // Weak, easily cracked
sha1($password)  // Weak, easily cracked
$password       // NEVER store plain text!
```

### 2. CSRF Protection

Laravel automatically protects against Cross-Site Request Forgery attacks.

**Every form MUST include:**
```blade
<form method="POST">
    @csrf  <!-- This generates a hidden token -->
    ...
</form>
```

**What CSRF Does:**
- Generates a unique token for each session
- Includes token in forms
- Verifies token on POST/PUT/DELETE requests
- Blocks requests with invalid/missing tokens

### 3. Session Regeneration

After login, ALWAYS regenerate session ID:

```php
$request->session()->regenerate();
```

**Why?**
Prevents session fixation attacks where attacker tricks victim into using attacker's session ID.

### 4. Input Validation

ALWAYS validate user input:

```php
$request->validate([
    'email' => ['required', 'email'],
    'password' => ['required', 'min:8'],
]);
```

**Why?**
- Prevents SQL injection
- Prevents script injection (XSS)
- Ensures data integrity

### 5. Mass Assignment Protection

In models, specify which fields can be mass-assigned:

```php
protected $fillable = ['name', 'email', 'password'];
```

**Why?**
Prevents attackers from setting fields like `is_admin` or `role` without permission.

### 6. Hide Sensitive Fields

```php
protected $hidden = ['password', 'remember_token'];
```

**Why?**
When converting User to JSON, these fields won't be included. Prevents accidental exposure in API responses.

---

## Common Beginner Questions

### Q: Where are sessions stored?

**A:** In `storage/framework/sessions/` folder (by default). Each session is a separate file.

### Q: How long do sessions last?

**A:** 2 hours by default (configurable in `config/session.php`).

### Q: What happens if I delete all session files?

**A:** All users will be logged out. They'll need to login again.

### Q: Can I use a database instead of files for sessions?

**A:** Yes! Edit `.env`:
```
SESSION_DRIVER=database
```
Then run: `php artisan session:table` and `php artisan migrate`

### Q: How does Laravel know which user is logged in?

**A:** Laravel reads the session ID from the cookie, opens the session file, gets the user ID, and loads the User model from the database.

### Q: What is Auth::user()?

**A:** It returns the currently logged-in User model. You can access their data: `Auth::user()->name`, `Auth::user()->email`, etc.

### Q: What is Auth::check()?

**A:** Returns `true` if user is logged in, `false` if not:
```php
if (Auth::check()) {
    // User is logged in
}
```

### Q: Can I manually log in a user?

**A:** Yes:
```php
Auth::login($user);
```

### Q: Can I login by user ID?

**A:** Yes:
```php
Auth::loginUsingId(1);  // Logs in user with ID = 1
```

---

## Next Steps

Now that you understand how Laravel authentication works:

1. **Test your implementation**: Register, login, logout, try protected routes
2. **Inspect the database**: See how passwords are hashed
3. **Check session files**: Look in `storage/framework/sessions/`
4. **Experiment**: Try accessing `/dashboard` without logging in
5. **Build more features**: Add password reset, email verification, etc.

**Resources:**
- [Laravel Docs - Authentication](https://laravel.com/docs/authentication)
- [Laravel Docs - Middleware](https://laravel.com/docs/middleware)
- [Laravel Docs - Hashing](https://laravel.com/docs/hashing)
