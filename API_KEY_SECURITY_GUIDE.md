# Phase 4: API Key Management - Security & Implementation Guide

## Overview

This document explains how API key encryption and security works in DataFusion AI. It's written for both beginners and experienced developers to understand the implementation.

---

## Table of Contents

1. [Encryption Explained Simply](#encryption-explained-simply)
2. [How It Works in DataFusion](#how-it-works-in-datafusion)
3. [Security Best Practices](#security-best-practices)
4. [Testing Security](#testing-security)
5. [Troubleshooting](#troubleshooting)

---

## Encryption Explained Simply

### What is Encryption?

**Encryption** is like putting your API key in a locked safe. Nobody can read it without the key to the safe.

```
Without Encryption:
Database stores → "sk-proj-abc123xyz789" (anyone with database access can see this!)

With Encryption:
Database stores → "eyJpdiI6IjRhNzM5..." (gibberish that's useless without the encryption key)
```

### Why Encrypt API Keys?

1. **Database Breach Protection**: If someone steals your database, they can't use the API keys
2. **Insider Threat Mitigation**: Even system administrators can't see raw keys
3. **Compliance**: Many regulations require sensitive data encryption
4. **Best Practice**: Industry standard for credential storage

---

## How It Works in DataFusion

### The Encryption Flow

```
┌─────────────────────────────────────────────────────────────────┐
│ 1. USER ADDS KEY                                                │
├─────────────────────────────────────────────────────────────────┤
│ User enters: sk-proj-abc123xyz789                               │
│      ↓                                                           │
│ Controller receives plain key                                   │
│      ↓                                                           │
│ Model's setApiKeyAttribute() called                             │
│      ↓                                                           │
│ Crypt::encryptString('sk-proj-abc123xyz789')                    │
│      ↓                                                           │
│ Database stores: "eyJpdiI6IjRhNzM5OGI4..."                      │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│ 2. APP USES KEY FOR API CALL                                    │
├─────────────────────────────────────────────────────────────────┤
│ Phase 5 needs to call OpenWeatherMap                            │
│      ↓                                                           │
│ Fetch from DB: "eyJpdiI6IjRhNzM5OGI4..."                        │
│      ↓                                                           │
│ Model's getApiKeyAttribute() called                             │
│      ↓                                                           │
│ Crypt::decryptString('eyJpdiI6IjRhNzM5...')                     │
│      ↓                                                           │
│ Returns: sk-proj-abc123xyz789                                   │
│      ↓                                                           │
│ Makes API call with real key                                    │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│ 3. USER VIEWS KEYS IN UI                                        │
├─────────────────────────────────────────────────────────────────┤
│ Frontend requests user's keys                                   │
│      ↓                                                           │
│ Controller: ApiKey::where('user_id', 1)->get()                  │
│      ↓                                                           │
│ Model returns MASKED version via getMaskedKeyAttribute()        │
│      ↓                                                           │
│ Frontend displays: "sk-****...****x789"                         │
│      ↓                                                           │
│ Raw key NEVER sent to browser                                   │
└─────────────────────────────────────────────────────────────────┘
```

### Laravel's Encryption System

DataFusion uses **Laravel's built-in Crypt facade**:

```php
// In ApiKey model

// ENCRYPT when setting
public function setApiKeyAttribute($value)
{
    $this->attributes['encrypted_key'] = Crypt::encryptString($value);
}

// DECRYPT when accessing
public function getApiKeyAttribute()
{
    return Crypt::decryptString($this->attributes['encrypted_key']);
}

// MASK for frontend display
public function getMaskedKeyAttribute()
{
    $key = $this->api_key; // Decrypts automatically
    return substr($key, 0, 4) . '****...' . substr($key, -4);
}
```

**Technical Details:**
- **Algorithm**: AES-256-CBC (Advanced Encryption Standard)
- **Key Size**: 256 bits (industry standard)
- **Automatic**: Laravel handles encryption/decryption transparently
- **Secure**: Uses authenticated encryption (protects against tampering)

---

## Security Best Practices

### 1. APP_KEY Protection

**CRITICAL**: Your `.env` file contains `APP_KEY` - this is the master encryption key.

```env
APP_KEY=base64:lZq3vR8kF9KmN2pT6yH8jD4sL1xW5cB3mV0nQ7eA=
```

**Security Rules:**

✅ **DO:**
- Keep `.env` in `.gitignore` (Never commit to Git)
- Use different `APP_KEY` for dev, staging, production
- Backup `APP_KEY` securely (password manager, secure vault)
- Rotate `APP_KEY` periodically (with data migration plan)

❌ **DON'T:**
- Commit `.env` to version control
- Share `APP_KEY` in Slack/email
- Use the same key across environments
- Change `APP_KEY` without migrating encrypted data

**What if APP_KEY leaks?**
1. Immediately rotate all user API keys
2. Generate new `APP_KEY`
3. Migrate existing data (complex - avoid this scenario!)
4. Audit access logs

### 2. User Isolation

**Every API key belongs to exactly ONE user:**

```php
// Database constraint
$table->foreignId('user_id')->constrained()->onDelete('cascade');

// Controller authorization
if ($apiKey->user_id !== Auth::id()) {
    abort(403, 'Unauthorized');
}

// Query scoping
ApiKey::where('user_id', Auth::id())->get();
```

**Tests for User Isolation:**
```php
// User A creates key
$keyA = ApiKey::create(['user_id' => 1, 'name' => 'My Key']);

// User B tries to access User A's key
Auth::loginAs($userB);
$key = ApiKey::find($keyA->id);
// Should return 403 Forbidden when trying to edit/delete
```

### 3. Never Expose Raw Keys

**Frontend Security:**

```php
// ❌ WRONG - exposes raw key
return response()->json([
    'api_key' => $apiKey->api_key,
]);

// ✅ CORRECT - masked version only
return response()->json([
    'masked_key' => $apiKey->masked_key,
]);
```

**Model Protection:**

```php
// Hidden from JSON serialization
protected $hidden = ['encrypted_key'];

// Accessor for safe display
public function getMaskedKeyAttribute()
{
    // Returns sk-****...****1234
}
```

### 4. Validation Rules

**Input Validation:**

```php
// Minimum security requirements
'api_key' => [
    'required',
    'string',
    'min:10',        // Prevent trivial keys
    'max:500',       // Reasonable length
],

// Provider-specific validation (future enhancement)
'api_key' => [
    'required',
    'regex:/^sk-proj-/',  // OpenAI format
],
```

### 5. HTTPS Only

**Production Configuration:**

```php
// config/session.php
'secure' => env('SESSION_SECURE_COOKIE', true),  // HTTPS only
'http_only' => true,  // Prevent JavaScript access
'same_site' => 'strict',  // CSRF protection
```

```env
# .env production
APP_ENV=production
APP_DEBUG=false
SESSION_SECURE_COOKIE=true
```

---

## Testing Security

### Manual Security Tests

#### Test 1: Verify Encryption in Database

```sql
-- Run this SQL query
SELECT id, name, encrypted_key FROM api_keys;

-- Expected result:
+----+--------------+------------------------------------------------+
| id | name         | encrypted_key                                  |
+----+--------------+------------------------------------------------+
|  1 | My Weather   | eyJpdiI6IjRhNzM5OGI4OWQyZT...                  |
+----+--------------+------------------------------------------------+

-- ❌ FAIL if you see: sk-proj-abc123 (plain text)
-- ✅ PASS if you see: gibberish/encrypted data
```

#### Test 2: User Isolation

1. Create API key as User A
2. Log in as User B
3. Try to access `/api-keys/{userAKeyId}/edit`
4. **Expected**: 403 Forbidden error
5. **Fail if**: User B can see/edit User A's key

#### Test 3: Frontend Exposure

1. Open browser DevTools → Network tab
2. Load API keys page
3. Inspect JSON response
4. **Expected**: Only `masked_key` field present
5. **Fail if**: `api_key` or `encrypted_key` in response

#### Test 4: Decryption Works

```php
// In tinker: php artisan tinker
$key = ApiKey::first();
echo $key->api_key;  // Should decrypt successfully
echo $key->masked_key;  // Should show sk-****...****1234
```

### Automated Security Tests

```php
// tests/Feature/ApiKeySecurityTest.php

public function test_api_keys_are_encrypted_in_database()
{
    $apiKey = ApiKey::create([
        'user_id' => 1,
        'api_provider_id' => 1,
        'name' => 'Test Key',
        'api_key' => 'sk-proj-plaintext',
    ]);
    
    // Check database contains encrypted value
    $dbValue = DB::table('api_keys')
        ->where('id', $apiKey->id)
        ->value('encrypted_key');
    
    $this->assertNotEquals('sk-proj-plaintext', $dbValue);
    $this->assertStringContainsString('eyJ', $dbValue); // Base64 encrypted
}

public function test_users_cannot_access_other_users_keys()
{
    $userA = User::factory()->create();
    $userB = User::factory()->create();
    
    $keyA = ApiKey::factory()->create(['user_id' => $userA->id]);
    
    $this->actingAs($userB)
        ->get("/api-keys/{$keyA->id}/edit")
        ->assertStatus(403);
}

public function test_raw_keys_not_exposed_in_json()
{
    $user = User::factory()->create();
    $apiKey = ApiKey::factory()->create(['user_id' => $user->id]);
    
    $this->actingAs($user)
        ->getJson('/api-keys')
        ->assertJsonMissing(['api_key' => $apiKey->api_key])
        ->assertJsonMissing(['encrypted_key']);
}
```

---

## Troubleshooting

### Problem: "DecryptException: The payload is invalid"

**Cause**: `APP_KEY` changed after data was encrypted

**Solution**:
```bash
# 1. Check if APP_KEY exists
php artisan key:generate --show

# 2. If you changed APP_KEY, you must re-encrypt all data
# WARNING: This will require migration script or manual re-entry
```

### Problem: User can see other users' API keys

**Cause**: Missing authorization check

**Fix:**
```php
// Add to controller
if ($apiKey->user_id !== Auth::id()) {
    abort(403);
}
```

### Problem: API keys visible in browser DevTools

**Cause**: Sending raw keys to frontend

**Fix:**
```php
// Use masked_key instead
'masked_key' => $apiKey->masked_key,  // ✅
'api_key' => $apiKey->api_key,        // ❌
```

---

## Summary

✅ **Implemented Security Features:**

1. **Encryption**: AES-256-CBC via Laravel Crypt
2. **User Isolation**: Foreign key constraints + authorization checks
3. **Masked Display**: Frontend only sees `sk-****...****1234`
4. **Hidden Raw Keys**: `$hidden` property prevents JSON exposure
5. **Validation**: Input sanitization and format checking

⚠️ **Critical Reminders:**

- **NEVER commit** `.env` or `APP_KEY`
- **ALWAYS verify** user ownership before operations
- **NEVER send** raw keys to frontend
- **BACKUP** your `APP_KEY` securely
- **TEST** user isolation and encryption regularly

🔐 **Your API keys are now as secure as industry best practices allow!**
