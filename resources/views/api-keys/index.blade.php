@extends('layouts.layout')

@section('content')
<div class="gradient-bg min-h-screen">
    
    <!-- Main Container with Sidebar -->
    <div class="flex">
        
        <!-- Sidebar Navigation -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Area -->
        <main class="flex-1 ml-64 bg-slate-50/50 min-h-screen">
            <!-- Top Navigation Bar -->
            <nav class="glass border-b border-slate-200 sticky top-0 z-30">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">API Key Management</h1>
                        <p class="text-sm font-medium text-slate-500">Securely manage your external API credentials</p>
                    </div>
                    
                    <button onclick="toggleModal('addModal')" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/20 transition-all duration-300 hover:scale-105 active:scale-95 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add API Key</span>
                    </button>
                </div>
            </nav>

            <!-- Content -->
            <div class="p-8 space-y-8">
                
                @if(count($apiKeys) > 0)
                    <!-- API Keys Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @foreach($apiKeys as $key)
                            <div class="glass p-8 rounded-3xl border border-slate-200 hover:border-indigo-400 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500 overflow-hidden relative group">
                                <!-- Background Glow Decoration -->
                                <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-colors duration-500"></div>

                                <!-- Header -->
                                <div class="flex items-start justify-between mb-6 relative z-10">
                                    <div class="flex items-start space-x-5">
                                        <div class="p-4 bg-indigo-50 rounded-2xl border border-indigo-100 shadow-sm group-hover:scale-110 transition-transform duration-500">
                                            <!-- Provider Icon -->
                                            @if($key['provider']['icon'] == 'cloud')
                                                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                </svg>
                                            @elseif($key['provider']['icon'] == 'newspaper')
                                                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                </svg>
                                            @elseif($key['provider']['icon'] == 'sparkles')
                                                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                            @elseif($key['provider']['icon'] == 'code')
                                                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <h3 class="font-bold text-slate-900 text-lg mb-0.5 tracking-tight">{{ $key['name'] }}</h3>
                                            <p class="text-sm font-semibold text-indigo-600">{{ $key['provider']['name'] }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Toggle -->
                                    <form action="{{ route('api-keys.toggle', $key['id']) }}" method="POST" class="inline relative z-10">
                                        @csrf
                                        <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-all duration-300 {{ $key['is_enabled'] ? 'bg-indigo-600' : 'bg-slate-300' }} hover:opacity-90">
                                            <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-300 {{ $key['is_enabled'] ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                        </button>
                                    </form>
                                </div>

                                <!-- Masked Key -->
                                <div class="mb-6 p-4 bg-slate-50/50 rounded-2xl border border-slate-100 flex items-center justify-between group/key transition-colors hover:bg-slate-100/50 relative z-10">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-1.5 bg-white rounded-lg shadow-sm">
                                            <svg class="w-4 h-4 text-slate-600 group-hover/key:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <code class="text-xs font-mono text-slate-500 font-bold tracking-wider">{{ $key['masked_key'] }}</code>
                                    </div>
                                    <div class="px-2 py-1 bg-white text-[10px] font-bold text-slate-600 rounded border border-slate-100 shadow-sm opacity-0 group-hover/key:opacity-100 transition-opacity uppercase tracking-tighter">Encrypted</div>
                                </div>

                                <!-- Status Badge & Metadata -->
                                <div class="flex items-center justify-between mb-6 relative z-10">
                                    <div>
                                        @if($key['status'] == 'active')
                                            <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-bold ring-4 ring-emerald-500/5">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                                <span>Active</span>
                                            </span>
                                        @elseif($key['status'] == 'error')
                                            <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-red-50 text-red-700 border border-red-100 text-xs font-bold ring-4 ring-red-500/5">
                                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                                <span>Error</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-100 text-xs font-bold ring-4 ring-amber-500/5">
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                <span>Pending Test</span>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-600 uppercase tracking-widest flex flex-col items-end">
                                        <span class="mb-0.5">Last used: <span class="text-slate-600">{{ $key['last_used_at'] ?? 'Never' }}</span></span>
                                        <span>Added: <span class="text-slate-600">{{ $key['created_at'] }}</span></span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-3 relative z-10">
                                    <button onclick="openEditModal({{ json_encode($key) }})" class="flex-1 px-4 py-2.5 bg-white border border-slate-200 hover:border-indigo-500/50 hover:bg-indigo-50/50 text-slate-700 hover:text-indigo-700 rounded-xl font-bold text-sm transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        <span>Edit Key</span>
                                    </button>
                                    
                                    <button onclick="confirmDelete({{ $key['id'] }}, '{{ $key['name'] }}')" class="p-2.5 bg-white border border-slate-200 hover:border-red-500/50 hover:bg-red-50/50 text-slate-600 hover:text-red-600 rounded-xl transition-all duration-300 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="glass p-20 rounded-3xl border-2 border-dashed border-slate-200 text-center bg-white/50">
                        <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner ring-8 ring-indigo-50/50 animate-bounce-slow">
                            <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-3 tracking-tight">No API Keys Yet</h3>
                        <p class="text-slate-500 max-w-sm mx-auto mb-8 font-medium">Connect your favorite data sources to start fusing intelligence. It takes less than a minute.</p>
                        <button onclick="toggleModal('addModal')" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/30 transition-all duration-300 hover:scale-105 active:scale-95 group">
                            <span>Add Your First API Key</span>
                            <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Security Notice -->
                <div class="glass p-8 rounded-3xl border border-indigo-100 bg-white/50 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-indigo-500/10 transition-colors"></div>
                    <div class="flex items-start space-x-5 relative z-10">
                        <div class="p-4 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-500/20 text-white">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg mb-1">🔒 Your Keys Are Secure</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed max-w-2xl">All API keys are encrypted using bank-grade AES-256-GCM encryption before being stored in our vault. Your keys are never exposed in plaintext to the frontend, logs, or our support team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add API Key Modal -->
<div id="addModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-md z-50 hidden items-center justify-center p-4">
    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 max-w-lg w-full shadow-2xl animate-modal-in relative overflow-hidden">
        <!-- Glow Decoration -->
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl"></div>
        
        <div class="flex items-center justify-between mb-8 relative z-10">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Add API Key</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Connect a new service to DataFusion</p>
            </div>
            <button onclick="toggleModal('addModal')" class="p-2 text-slate-600 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('api-keys.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            
            <!-- Provider Selection -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">API Provider</label>
                <div class="relative group">
                    <select name="api_provider_id" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 text-slate-900 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all appearance-none font-medium">
                        <option value="">Select a provider...</option>
                        @foreach($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                @error('api_provider_id')
                    <p class="text-red-500 text-xs font-bold mt-2 ml-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Key Nickname</label>
                <input type="text" name="name" required placeholder="e.g. Production Weather Key" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 text-slate-900 rounded-2xl placeholder:text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium">
                @error('name')
                    <p class="text-red-500 text-xs font-bold mt-2 ml-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- API Key -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">API Key Content</label>
                <div class="relative">
                    <input type="password" name="api_key" required placeholder="••••••••••••••••" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 text-slate-900 rounded-2xl placeholder:text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-mono text-sm tracking-widest">
                </div>
                <div class="mt-3 p-3 bg-indigo-50 border border-indigo-100 rounded-xl flex items-start space-x-3">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <p class="text-[11px] font-bold text-indigo-700 leading-tight uppercase tracking-tighter">Your key is encrypted instantly with AES-256-GCM before it ever hits our database.</p>
                </div>
                @error('api_key')
                    <p class="text-red-500 text-xs font-bold mt-2 ml-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="button" onclick="toggleModal('addModal')" class="flex-1 px-6 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold transition-all active:scale-95 uppercase tracking-widest text-xs">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-6 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/20 transition-all active:scale-95 uppercase tracking-widest text-xs">
                    Securely Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-md z-50 hidden items-center justify-center p-4">
    <div class="bg-white p-10 rounded-[2.5rem] border border-red-100 max-w-md w-full shadow-2xl animate-modal-in">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 ring-8 ring-red-50/50">
                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 mb-2 tracking-tight">Delete Key?</h2>
            <p class="text-slate-500 font-medium px-4" id="deleteKeyName"></p>
            <div class="mt-4 inline-block px-3 py-1 bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-widest rounded-full">Permanent Action</div>
        </div>

        <form id="deleteForm" method="POST" class="flex space-x-4">
            @csrf
            @method('DELETE')
            <button type="button" onclick="toggleModal('deleteModal')" class="flex-1 px-6 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold transition-all active:scale-95 uppercase tracking-widest text-xs">
                Keep Key
            </button>
            <button type="submit" class="flex-1 px-6 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-bold shadow-xl shadow-red-500/20 transition-all active:scale-95 uppercase tracking-widest text-xs">
                Confirm Delete
            </button>
        </form>
    </div>
</div>

<!-- Edit API Key Modal -->
<div id="editModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-md z-50 hidden items-center justify-center p-4">
    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 max-w-lg w-full shadow-2xl animate-modal-in relative overflow-hidden">
        <!-- Glow Decoration -->
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl"></div>
        
        <div class="flex items-center justify-between mb-8 relative z-10">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit API Key</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Update your service credentials</p>
            </div>
            <button onclick="toggleModal('editModal')" class="p-2 text-slate-600 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-6 relative z-10">
            @csrf
            @method('PUT')
            
            <!-- Provider (Read Only) -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">API Provider</label>
                <div class="relative">
                    <input type="text" id="edit_provider_name" readonly class="w-full px-5 py-4 bg-slate-100 border border-slate-200 text-slate-600 rounded-2xl cursor-not-allowed font-bold">
                    <div class="absolute right-5 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Key Nickname</label>
                <input type="text" name="name" id="edit_name" required placeholder="Nickname" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 text-slate-900 rounded-2xl placeholder:text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium">
                @error('name')
                    <p class="text-red-500 text-xs font-bold mt-2 ml-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- API Key (Optional Update) -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Update API Key <span class="text-[10px] text-slate-600 font-bold uppercase tracking-widest ml-1">(Optional)</span></label>
                <input type="password" name="api_key" placeholder="••••••••••••••••" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 text-slate-900 rounded-2xl placeholder:text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-mono text-sm tracking-widest">
                <div class="mt-3 p-3 bg-indigo-50 border border-indigo-100 rounded-xl flex items-start space-x-3">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-[11px] font-bold text-indigo-700 leading-tight uppercase tracking-tighter">Leave this field blank to keep your current encrypted key securely stored.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="button" onclick="toggleModal('editModal')" class="flex-1 px-6 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold transition-all active:scale-95 uppercase tracking-widest text-xs">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-6 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/20 transition-all active:scale-95 uppercase tracking-widest text-xs">
                    Update Securely
                </button>
            </div>
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
        document.getElementById('edit_name').value = key.name;
        document.getElementById('edit_provider_name').value = key.provider.name;
        document.getElementById('editForm').action = `/api-keys/${key.id}`;
        toggleModal('editModal');
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
