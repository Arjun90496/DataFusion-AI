<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * RegisterController
 * 
 * Handles user registration for DataFusion AI.
 * 
 * BEGINNER EXPLANATION:
 * - Controllers receive HTTP requests and return responses
 * - This controller has 2 methods:
 *   1. showRegistrationForm() - shows the registration page (GET request)
 *   2. register() - processes the registration form (POST request)
 */
class RegisterController extends Controller
{
    /**
     * Show the registration form.
     * 
     * WHAT HAPPENS:
     * 1. User visits /register URL
     * 2. Laravel calls this method
     * 3. This method returns the registration view
     * 4. User sees the registration form
     * 
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     * 
     * STEP-BY-STEP FLOW:
     * 1. User fills out registration form and clicks "Register"
     * 2. Browser sends POST request to /register with form data
     * 3. Laravel calls this register() method with the Request object
     * 4. We validate the input (check if email is valid, password is strong, etc.)
     * 5. If validation fails, user is redirected back with error messages
     * 6. If validation passes, we create a new user in the database
     * 7. We hash the password using bcrypt (one-way encryption)
     * 8. We automatically log in the new user
     * 9. We redirect them to the dashboard
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // STEP 1: Validate the incoming request data
        // 
        // WHAT VALIDATION DOES:
        // - Checks if all required fields are filled
        // - Checks if data format is correct (e.g., valid email)
        // - If validation fails, Laravel automatically redirects back
        //   with error messages that you can display in the view
        $validated = $request->validate([
            // Name is required, must be a string, max 255 characters
            'name' => ['required', 'string', 'max:255'],
            
            // Email validation rules:
            // - required: must be filled
            // - string: must be text
            // - email: must be valid email format (contains @, proper structure)
            // - max:255: maximum 255 characters
            // - unique:users: must not already exist in 'users' table
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            
            // Password validation rules:
            // - required: must be filled
            // - string: must be text
            // - min:8: minimum 8 characters (security best practice)
            // - confirmed: must match 'password_confirmation' field
            //   (Laravel automatically checks for a field named password_confirmation)
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // STEP 2: Create the user in the database
        // 
        // HOW PASSWORD HASHING WORKS:
        // - Hash::make() uses bcrypt algorithm to hash the password
        // - Original password: "mypassword123"
        // - Hashed version: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
        // - The hash is one-way: you can't reverse it to get the original password
        // - When user logs in, we hash their input and compare to stored hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // STEP 3: Automatically log in the newly registered user
        // 
        // WHAT Auth::login() DOES:
        // 1. Creates a session on the server
        // 2. Stores the user's ID in the session
        // 3. Sends a cookie to the browser with the session ID
        // 4. User is now "authenticated" (logged in)
        Auth::login($user);

        // STEP 4: Redirect to the dashboard
        // 
        // with() attaches a flash message to the session
        // Flash messages only exist for the NEXT request, then disappear
        // Perfect for showing "success" or "error" messages
        return redirect()->route('dashboard')->with('success', 'Welcome to DataFusion AI!');
    }

    /**
     * HOW TO TEST THIS:
     * 
     * 1. Go to http://localhost:8000/register
     * 2. Fill in the form:
     *    - Name: John Doe
     *    - Email: john@example.com
     *    - Password: password123
     *    - Confirm Password: password123
     * 3. Click "Register"
     * 4. You should be redirected to /dashboard
     * 5. Check your database - new user should exist with hashed password
     * 
     * TESTING VALIDATION:
     * - Try registering with an invalid email (e.g., "notanemail")
     * - Try using a short password (less than 8 characters)
     * - Try using non-matching passwords
     * - Try registering with the same email twice
     * - Each should show appropriate error messages
     */
}
