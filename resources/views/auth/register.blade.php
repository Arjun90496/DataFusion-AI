@extends('layouts.layout')

@section('content')
<div class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full animate-fade-in">
        
        <!-- Logo/Header -->
        <div class="text-center mb-10">
            <a href="{{ route('welcome') }}" class="inline-block group">
                <div class="inline-flex items-center space-x-4 mb-6">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-500/10 border border-slate-100 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-black text-slate-900 tracking-tighter">DataFusion</span>
                </div>
            </a>
            <h1 class="text-xl font-bold text-slate-500 uppercase tracking-[0.2em]">Workspace Initiation</h1>
        </div>

        <!-- Registration Card -->
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-2xl shadow-indigo-500/5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-2xl -mr-16 -mt-16"></div>
            <h2 class="text-2xl font-black text-slate-900 text-center mb-8 tracking-tight">Create Entity Profile</h2>

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">
                        Operator Name
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 text-slate-900 rounded-2xl placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/50 transition duration-300 @error('name') border-red-200 ring-4 ring-red-500/5 @enderror"
                            placeholder="Alex Thorne"
                        >
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-400 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">
                        Deployment Email
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 text-slate-900 rounded-2xl placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/50 transition duration-300 @error('email') border-red-200 ring-4 ring-red-500/5 @enderror"
                            placeholder="operator@datafusion.ai"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">
                        Secure Key
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 text-slate-900 rounded-2xl placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/50 transition duration-300 @error('password') border-red-200 ring-4 ring-red-500/5 @enderror"
                            placeholder="••••••••••••"
                        >
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @else
                        <p class="mt-1 text-xs text-slate-500 flex items-center space-x-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Must be at least 8 characters long</span>
                        </p>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">
                        Verify Key
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 text-slate-900 rounded-2xl placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/50 transition duration-300"
                            placeholder="••••••••••••"
                        >
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full px-8 py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black shadow-xl shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center space-x-3"
                >
                    <span class="text-lg tracking-tight">Generate Workspace</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>

                <!-- Terms -->
                <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">
                    By initiating, you agree to our 
                    <a href="#" class="text-indigo-600 hover:underline">Intelligence Terms</a> and 
                    <a href="#" class="text-indigo-600 hover:underline">Privacy Charter</a>
                </p>
            </form>

            <!-- Divider -->
            <div class="relative my-10">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-6 bg-white text-slate-400 font-bold uppercase tracking-[0.2em]">Established Node?</span>
                </div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="group inline-flex items-center space-x-2 text-sm font-black text-indigo-600 hover:text-indigo-700 transition-colors">
                    <span>Member Recognition</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Intelligence Grid Badge -->
        <div class="mt-10 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-500/5 rounded-full blur-xl -mr-10 -mt-10 group-hover:bg-indigo-500/10 transition-colors"></div>
            <div class="grid grid-cols-2 gap-6 relative z-10">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Multi-Node</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">AI Synthesis</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
