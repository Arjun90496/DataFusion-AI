<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * LoginController
 * 
 * Handles user login and logout for DataFusion AI.
 * 
 * BEGINNER EXPLANATION:
 * This controller has 3 main methods:
 * 1. showLoginForm() - displays the login page
 * 2. login() - authenticates the user
 * 3. logout() - logs out the user
 */
class LoginController extends Controller
{
    /**
     * Show the login form.
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     * 
     * STEP-BY-STEP LOGIN FLOW:
     * 1. User enters email and password
     * 2. Browser sends POST request to /login
     * 3. Laravel calls this method
     * 4. We validate the input format (not checking if credentials are correct yet)
     * 5. We attempt authentication using Auth::attempt()
     * 6. Auth::attempt() does:
     *    a. Finds user by email in database
     *    b. Hashes the provided password
     *    c. Compares hashed password with stored hash
     *    d. If they match → login successful
     *    e. If they don't match → login fails
     * 7. If successful: create session, regenerate session ID (security), redirect to dashboard
     * 8. If failed: redirect back with error message
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // STEP 1: Validate the input format
        // 
        // IMPORTANT: This does NOT check if credentials are correct!
        // It only checks if the email looks valid and password is filled
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // STEP 2: Attempt to authenticate the user
        // 
        // HOW Auth::attempt() WORKS INTERNALLY:
        // 1. SELECT * FROM users WHERE email = 'entered_email'
        // 2. If user not found → return false
        // 3. If user found → hash the entered password
        // 4. Compare: password_verify(entered_password, stored_hash)
        // 5. If match → create session, store user ID → return true
        // 6. If no match → return false
        // 
        // REMEMBER ME FUNCTIONALITY:
        // - $request->boolean('remember') checks if "Remember Me" checkbox was checked
        // - If true, Laravel creates a long-lived token and stores it in:
        //   a. Database (remember_token column)
        //   b. Browser cookie (lasts for weeks/months)
        // - Even after browser closes, user stays logged in
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // SECURITY: Regenerate session ID after login
            // 
            // WHY REGENERATE SESSION ID?
            // - Prevents "session fixation" attacks
            // - Attack scenario without regeneration:
            //   1. Attacker tricks you into using their session ID
            //   2. You log in with that session ID
            //   3. Attacker now has access to your logged-in session
            // - By regenerating, we create a NEW session ID that attacker doesn't know
            $request->session()->regenerate();

            // Get the authenticated user's name for personalized message
            $userName = Auth::user()->name;

            // Redirect to dashboard with success message
            return redirect()->intended('dashboard')
                ->with('success', "Welcome back, {$userName}!");
        }

        // STEP 3: If authentication failed, redirect back with error
        // 
        // withErrors() adds error messages that can be displayed in the view
        // 'email' is the field name, so error appears next to email input
        // back() returns user to the previous page (the login form)
        // withInput() keeps the email field filled (but NOT password for security)
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle user logout.
     * 
     * LOGOUT FLOW:
     * 1. User clicks "Logout" button
     * 2. Browser sends POST request to /logout
     * 3. Laravel calls this method
     * 4. We log out the user (destroy session)
     * 5. We invalidate the session (delete session file)
     * 6. We regenerate CSRF token (security)
     * 7. We redirect to login page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // STEP 1: Log out the user
        // 
        // WHAT Auth::logout() DOES:
        // 1. Removes user ID from session
        // 2. Clears authentication data
        // 3. User is no longer "logged in"
        Auth::logout();

        // STEP 2: Invalidate the entire session
        // 
        // WHY INVALIDATE?
        // - Deletes the session file from server
        // - Prevents someone from using old session data
        // - Important if user logged out from public computer
        $request->session()->invalidate();

        // STEP 3: Regenerate CSRF token
        // 
        // WHAT IS CSRF TOKEN?
        // - Security token that prevents Cross-Site Request Forgery attacks
        // - Every form in Laravel has a hidden CSRF token
        // - After logout, we create a new token to prevent old forms from being submitted
        $request->session()->regenerateToken();

        // STEP 4: Redirect to login page
        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * HOW SESSION-BASED AUTHENTICATION WORKS:
     * 
     * WHEN YOU LOGIN:
     * ┌─────────────┐                  ┌─────────────┐
     * │   Browser   │     POST /login  │   Laravel   │
     * │             │─────────────────>│   Server    │
     * │             │   email+password │             │
     * │             │                  │  1. Verify  │
     * │             │                  │  2. Create  │
     * │             │                  │     session │
     * │             │<─────────────────│  3. Send    │
     * │             │   SessionID      │     cookie  │
     * │  Stores     │   (in cookie)    │             │
     * │  SessionID  │                  │             │
     * └─────────────┘                  └─────────────┘
     * 
     * ON EVERY SUBSEQUENT REQUEST:
     * ┌─────────────┐                  ┌─────────────┐
     * │   Browser   │   GET /dashboard │   Laravel   │
     * │             │─────────────────>│   Server    │
     * │  Sends      │   + SessionID    │             │
     * │  SessionID  │    (in cookie)   │  1. Read    │
     * │  cookie     │                  │     session │
     * │             │                  │  2. Get     │
     * │             │                  │     user ID │
     * │             │<─────────────────│  3. Load    │
     * │             │   Dashboard      │     user    │
     * │             │   page           │     data    │
     * └─────────────┘                  └─────────────┘
     * 
     * WHEN YOU LOGOUT:
     * - Session file deleted from server
     * - Session cookie deleted from browser
     * - User is no longer authenticated
     */
}
