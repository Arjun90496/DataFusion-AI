@extends('layouts.layout')

@section('title', 'Account Settings')

@section('content')
<div class="min-h-screen bg-slate-50/50">
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Account Configuration</h1>
            <p class="text-slate-500 font-medium">Manage your personal identity, security credentials, and system preferences.</p>
        </div>

        <div class="space-y-10 pb-20">
            <!-- Profile Information -->
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
                
                <div class="flex items-center space-x-5 mb-10 pb-8 border-b border-slate-100 relative z-10">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-inner border border-indigo-100 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Identity & Profile</h2>
                        <p class="text-sm font-medium text-slate-600">Essential account information and public visibility.</p>
                    </div>
                </div>

                <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                        <div>
                            <label for="name" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 px-1">Display Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold placeholder-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all shadow-sm"
                                required>
                            @error('name') <p class="text-red-500 text-xs font-bold mt-2 px-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 px-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold placeholder-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all shadow-sm"
                                required>
                            @error('email') <p class="text-red-500 text-xs font-bold mt-2 px-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-10 mt-10 border-t border-slate-100 relative z-10">
                        <div class="flex items-center space-x-5 mb-8">
                            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 shadow-inner border border-purple-100 transition-transform duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Security Credentials</h3>
                                <p class="text-sm font-medium text-slate-600">Reset your access password and protect your vault.</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="current_password" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 px-1">Current Password</label>
                                <input type="password" name="current_password" id="current_password" 
                                    class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all shadow-sm">
                                @error('current_password') <p class="text-red-500 text-xs font-bold mt-2 px-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label for="new_password" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 px-1">New Secure Password</label>
                                    <input type="password" name="new_password" id="new_password" 
                                        class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all shadow-sm">
                                    @error('new_password') <p class="text-red-500 text-xs font-bold mt-2 px-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="new_password_confirmation" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 px-1">Confirm Security Key</label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                        class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-8 mt-4 relative z-10">
                        <button type="submit" class="px-12 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95 flex items-center space-x-3">
                            <span>Synchronize Changes</span>
                            <svg class="w-5 h-5 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Dangerous Area -->
            <div class="bg-red-50/50 p-10 rounded-[2.5rem] border border-red-100 group">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-600 border border-red-200 group-hover:bg-red-600 group-hover:text-slate-900 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-red-900 tracking-tight">Deactivate Intelligence Entity</h3>
                        <p class="text-sm font-medium text-red-600 opacity-60">This action is permanent and irrecoverable.</p>
                    </div>
                </div>
                <p class="text-slate-500 font-medium mb-8 leading-relaxed">Once you initiate deletion, all your fused data, encrypted API keys, and strategic insights will be purged from our secure infrastructure within 24 hours. There is no backup facility for this action.</p>
                <button class="px-8 py-4 bg-white border border-red-200 text-red-600 rounded-2xl hover:bg-red-600 hover:text-slate-900 hover:border-red-600 transition-all font-bold shadow-sm active:scale-95">
                    Execute Account Deletion
                </button>
            </div>
        </div>
    </div>
</div>
@extends('layouts.layout')

@section('title', 'Settings')

@section('content')
<div class="gradient-bg min-h-screen">
    <div class="flex">
        @include('layouts.partials.sidebar')
        
        <main class="flex-1 ml-64 bg-slate-50/50 min-h-screen">
            <!-- Header -->
            <nav class="glass border-b border-slate-200 sticky top-0 z-30">
                <div class="px-8 py-4">
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Settings</h1>
                    <p class="text-sm font-medium text-slate-500">Manage your account and preferences</p>
                </div>
            </nav>

            <div class="p-8 space-y-8 max-w-4xl">
                <!-- Account Settings -->
                <div class="glass p-8 rounded-2xl border border-slate-200 bg-white">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Account Settings</h2>
                    <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold transition-all active:scale-95">
                            Save Changes
                        </button>
                    </form>
                </div>

                <!-- Notification Preferences -->
                <div class="glass p-8 rounded-2xl border border-slate-200 bg-white">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Notification Preferences</h2>
                    <div class="space-y-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 rounded border-slate-300" checked>
                            <span class="text-slate-700 font-medium">Email notifications for new insights</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 rounded border-slate-300" checked>
                            <span class="text-slate-700 font-medium">Daily digest of API activity</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 rounded border-slate-300">
                            <span class="text-slate-700 font-medium">Alert on API errors</span>
                        </label>
                    </div>
                </div>

                <!-- Data & Privacy -->
                <div class="glass p-8 rounded-2xl border border-slate-200 bg-white">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Data & Privacy</h2>
                    <div class="space-y-6">
                        <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg">
                            <p class="text-sm text-blue-900 font-medium">📦 Your data is encrypted with AES-256-GCM and stored securely.</p>
                        </div>
                        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold transition-all active:scale-95">
                            Download My Data
                        </button>
                        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold transition-all active:scale-95">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
