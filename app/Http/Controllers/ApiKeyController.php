<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\ApiProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * ApiKeyController
 * 
 * Handles CRUD operations for user API keys with security features:
 * - User isolation (users can only manage their own keys)
 * - Encryption/decryption via ApiKey model
 * - Validation and sanitization
 * - Enable/disable functionality
 * 
 * SECURITY:
 * - All routes protected by 'auth' middleware
 * - Authorization checks on every action
 * - API keys never exposed to frontend (only masked)
 */
class ApiKeyController extends Controller
{
    /**
     * Display API key management page
     * 
     * Shows user's API keys and available providers
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get user's API keys with provider relationship
        $apiKeys = ApiKey::where('user_id', Auth::id())
            ->with('provider')
            ->latest()
            ->get()
            ->map(function ($apiKey) {
                // Add masked key for display
                return [
                    'id' => $apiKey->id,
                    'name' => $apiKey->name,
                    'masked_key' => $apiKey->masked_key,  // Secure masked version
                    'is_enabled' => $apiKey->is_enabled,
                    'status' => $apiKey->status,
                    'status_message' => $apiKey->status_message,
                    'last_used_at' => $apiKey->last_used_at?->diffForHumans(),
                    'provider' => [
                        'id' => $apiKey->provider->id,
                        'name' => $apiKey->provider->name,
                        'icon' => $apiKey->provider->icon,
                        'color' => $apiKey->provider->color,
                    ],
                    'created_at' => $apiKey->created_at->diffForHumans(),
                ];
            });
        
        // Get active providers for "Add API Key" form
        $providers = ApiProvider::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        return view('api-keys.index', compact('apiKeys', 'providers'));
    }
    
    /**
     * Store a new API key
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'api_provider_id' => 'required|exists:api_providers,id',
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure name is unique for this user and provider combination
                Rule::unique('api_keys')->where(function ($query) use ($request) {
                    return $query->where('user_id', Auth::id())
                        ->where('api_provider_id', $request->api_provider_id);
                }),
            ],
            'api_key' => 'required|string|min:10|max:500',
        ], [
            'api_provider_id.required' => 'Please select an API provider.',
            'api_provider_id.exists' => 'Invalid API provider selected.',
            'name.required' => 'Please enter a name for this API key.',
            'name.unique' => 'You already have an API key with this name for this provider.',
            'api_key.required' => 'Please enter your API key.',
            'api_key.min' => 'API key must be at least 10 characters.',
        ]);
        
        // Create API key (encryption happens automatically via model mutator)
        $apiKey = ApiKey::create([
            'user_id' => Auth::id(),
            'api_provider_id' => $validated['api_provider_id'],
            'name' => $validated['name'],
            'api_key' => $validated['api_key'],  // Encrypted by setApiKeyAttribute()
            'is_enabled' => true,
            'status' => 'pending',  // Will be tested later
        ]);
        
        return redirect()->route('api-keys.index')
            ->with('success', 'API key added successfully! You can now use it to fetch data.');
    }
    
    /**
     * Show edit form for API key
     * 
     * @param \App\Models\ApiKey $apiKey
     * @return \Illuminate\View\View
     */
    public function edit(ApiKey $apiKey)
    {
        // Authorization: Ensure user owns this key
        if ($apiKey->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $providers = ApiProvider::where('is_active', true)->orderBy('name')->get();
        
        return view('api-keys.edit', compact('apiKey', 'providers'));
    }
    
    /**
     * Update an existing API key
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ApiKey $apiKey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ApiKey $apiKey)
    {
        // Authorization: Ensure user owns this key
        if ($apiKey->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validation rules
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Unique except for current key
                Rule::unique('api_keys')->where(function ($query) use ($apiKey) {
                    return $query->where('user_id', Auth::id())
                        ->where('api_provider_id', $apiKey->api_provider_id);
                })->ignore($apiKey->id),
            ],
            'api_key' => 'nullable|string|min:10|max:500',  // Optional when updating
        ]);
        
        // Update name
        $apiKey->name = $validated['name'];
        
        // Update API key if provided (will be re-encrypted)
        if (!empty($validated['api_key'])) {
            $apiKey->api_key = $validated['api_key'];  // Re-encrypted by mutator
            $apiKey->status = 'pending';  // Mark for re-testing
            $apiKey->status_message = null;
        }
        
        $apiKey->save();
        
        return redirect()->route('api-keys.index')
            ->with('success', 'API key updated successfully!');
    }
    
    /**
     * Delete an API key
     * 
     * @param \App\Models\ApiKey $apiKey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ApiKey $apiKey)
    {
        // Authorization: Ensure user owns this key
        if ($apiKey->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $apiKey->delete();
        
        return redirect()->route('api-keys.index')
            ->with('success', 'API key deleted successfully.');
    }
    
    /**
     * Toggle enable/disable status
     * 
     * Allows soft-disabling keys without deletion
     * 
     * @param \App\Models\ApiKey $apiKey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(ApiKey $apiKey)
    {
        // Authorization: Ensure user owns this key
        if ($apiKey->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Toggle the is_enabled status
        $apiKey->is_enabled = !$apiKey->is_enabled;
        $apiKey->save();
        
        $status = $apiKey->is_enabled ? 'enabled' : 'disabled';
        
        return back()->with('success', "API key {$status} successfully!");
    }

    /**
     * Fetch data using the API key
     */
    public function fetchData(\Illuminate\Http\Request $request, ApiKey $apiKey)
    {
        // Authorization: Ensure user owns this key
        if ($apiKey->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $result = $apiKey->fetch($request->all());
            return response()->json($result->toArray(), $result->statusCode);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
