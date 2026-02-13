@extends('layouts.layout')

@section('content')
<div class="gradient-bg min-h-screen">
    
    <!-- Main Container with Sidebar -->
    <div class="flex">
        
        <!-- Sidebar Navigation (same as dashboard) -->
        <aside class="fixed left-0 top-0 h-screen w-64 glass border-r border-slate-800 z-40">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="p-6 border-b border-slate-800">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/50">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-lg font-bold gradient-text">DataFusion AI</span>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="p-6 border-b border-slate-800">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-200 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- API Keys (Active) -->
                    <a href="{{ route('api-keys.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-indigo-600/20 border border-indigo-500/50 text-indigo-300 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span class="font-medium">API Keys</span>
                    </a>

                    <!-- Other Links -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                        </svg>
                        <span class="font-medium">Data Fusion</span>
                        <span class="ml-auto text-xs bg-purple-500/20 text-purple-300 px-2 py-1 rounded-full">Phase 6</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <span class="font-medium">AI Insights</span>
                        <span class="ml-auto text-xs bg-pink-500/20 text-pink-300 px-2 py-1 rounded-full">Phase 7</span>
                    </a>

                    <div class="pt-4 pb-2"><div class="border-t border-slate-800"></div></div>

                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="p-4 border-t border-slate-800">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 ml-64">
            <!-- Top Navigation Bar -->
            <nav class="glass border-b border-slate-800 sticky top-0 z-30">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-100">API Key Management</h1>
                        <p class="text-sm text-slate-400">Securely manage your external API credentials</p>
                    </div>
                    
                    <button onclick="toggleModal('addModal')" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/40 hover:shadow-indigo-500/60 transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add API Key</span>
                    </button>
                </div>
            </nav>

            <!-- Content -->
            <div class="p-8 space-y-6">
                
                @if(count($apiKeys) > 0)
                    <!-- API Keys Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach($apiKeys as $key)
                            <div class="glass p-6 rounded-2xl border border-slate-800 hover:border-{{ $key['provider']['color'] }}-500/50 transition-all duration-300">
                                <!-- Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="p-3 bg-{{ $key['provider']['color'] }}-500/10 rounded-lg">
                                            <!-- Provider Icon -->
                                            @if($key['provider']['icon'] == 'cloud')
                                                <svg class="w-6 h-6 text-{{ $key['provider']['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                </svg>
                                            @elseif($key['provider']['icon'] == 'newspaper')
                                                <svg class="w-6 h-6 text-{{ $key['provider']['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                </svg>
                                            @elseif($key['provider']['icon'] == 'sparkles')
                                                <svg class="w-6 h-6 text-{{ $key['provider']['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                            @elseif($key['provider']['icon'] == 'code')
                                                <svg class="w-6 h-6 text-{{ $key['provider']['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <h3 class="font-bold text-slate-100 mb-1">{{ $key['name'] }}</h3>
                                            <p class="text-sm text-slate-400">{{ $key['provider']['name'] }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Toggle -->
                                    <form action="{{ route('api-keys.toggle', $key['id']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $key['is_enabled'] ? 'bg-indigo-600' : 'bg-slate-700' }}">
                                            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $key['is_enabled'] ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                        </button>
                                    </form>
                                </div>

                                <!-- Masked Key -->
                                <div class="mb-4 p-3 bg-slate-900/50 rounded-lg border border-slate-700">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <code class="text-sm font-mono text-slate-300">{{ $key['masked_key'] }}</code>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="mb-4">
                                    @if($key['status'] == 'active')
                                        <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-sm">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                            <span>Active</span>
                                        </span>
                                    @elseif($key['status'] == 'error')
                                        <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-red-500/20 text-red-300 text-sm">
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                            <span>Error</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-sm">
                                            <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                            <span>Pending Test</span>
                                        </span>
                                    @endif
                                </div>

                                <!-- Metadata -->
                                <div class="flex items-center justify-between text-xs text-slate-600 mb-4">
                                    <span>Last used: {{ $key['last_used_at'] ?? 'Never' }}</span>
                                    <span>Added {{ $key['created_at'] }}</span>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    <button onclick="openEditModal({{ json_encode($key) }})" class="flex-1 px-4 py-2 glass border border-sl ate-700 hover:border-indigo-500/50 text-slate-300 hover:text-indigo-300 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </button>
                                    
                                    <button onclick="confirmDelete({{ $key['id'] }}, '{{ $key['name'] }}')" class="px-4 py-2 glass border border-slate-700 hover:border-red-500/50 text-slate-300 hover:text-red-300 rounded-lg font-semibold transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="glass p-16 rounded-2xl border-2 border-dashed border-slate-700 text-center">
                        <svg class="w-20 h-20 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-slate-300 mb-3">No API Keys Yet</h3>
                        <p class="text-slate-500 mb-6">Add your first API key to start fetching data from external services</p>
                        <button onclick="toggleModal('addModal')" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105">
                            Add Your First API Key
                        </button>
                    </div>
                @endif

                <!-- Security Notice -->
                <div class="glass p-6 rounded-xl border border-indigo-500/30">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-indigo-500/10 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-100 mb-2">🔒 Your Keys Are Secure</h4>
                            <p class="text-sm text-slate-400">All API keys are encrypted using AES-256 encryption before being stored. Your keys are never exposed in plaintext to the frontend or logs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add API Key Modal -->
<div id="addModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="glass p-8 rounded-2xl border border-slate-700 max-w-md w-full mx-4 animate-fade-in">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-100">Add API Key</h2>
            <button onclick="toggleModal('addModal')" class="text-slate-400 hover:text-slate-200 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('api-keys.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Provider Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">API Provider</label>
                <select name="api_provider_id" required class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 text-slate-100 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    <option value="">Select a provider...</option>
                    @foreach($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
                @error('api_provider_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Nickname</label>
                <input type="text" name="name" required placeholder="My Weather API" class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 text-slate-100 rounded-lg placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- API Key -->
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">API Key</label>
                <input type="text" name="api_key" required placeholder="sk-proj-..." class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 text-slate-100 rounded-lg placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition font-mono text-sm">
                <p class="text-xs text-slate-500 mt-2 flex items-center space-x-1">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span>Your key will be encrypted before storage</span>
                </p>
                @error('api_key')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="toggleModal('addModal')" class="flex-1 px-6 py-3 glass border border-slate-700 hover:border-slate-600 text-slate-300 rounded-lg font-semibold transition-all">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/40 transition-all duration-300">
                    Save Key
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="glass p-8 rounded-2xl border border-red-500/30 max-w-md w-full mx-4">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-100 mb-2">Delete API Key?</h2>
            <p class="text-slate-400" id="deleteKeyName"></p>
            <p class="text-sm text-red-400 mt-2">This action cannot be undone.</p>
        </div>

        <form id="deleteForm" method="POST" class="flex space-x-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="toggleModal('deleteModal')" class="flex-1 px-6 py-3 glass border border-slate-700 hover:border-slate-600 text-slate-300 rounded-lg font-semibold transition-all">
                Cancel
            </button>
            <button type="submit" class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-all">
                Delete
            </button>
        </form>
    </div>
</div>

<!-- JavaScript for Modals -->
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }

    function confirmDelete(keyId, keyName) {
        document.getElementById('deleteKeyName').textContent = `"${keyName}" will be permanently deleted.`;
        document.getElementById('deleteForm').action = `/api-keys/${keyId}`;
        toggleModal('deleteModal');
    }

    function openEditModal(key) {
        // For now, show alert - in future, create edit modal
        alert(`Edit functionality: Would edit "${key.name}"\nImplement edit modal similar to add modal.`);
    }

    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        }
    });
</script>
@endsection
