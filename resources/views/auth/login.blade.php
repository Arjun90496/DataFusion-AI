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
            <h1 class="text-xl font-bold text-slate-500 uppercase tracking-[0.2em]">Authentication Required</h1>
        </div>

        <!-- Login Card -->
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-2xl shadow-indigo-500/5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-2xl -mr-16 -mt-16"></div>
            <h2 class="text-2xl font-black text-slate-900 text-center mb-8 tracking-tight">Access Your Workspace</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">
                        Deployment Email
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            autofocus
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
                        Encrypted Key
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
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between px-1">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="w-5 h-5 bg-slate-50 border-slate-200 rounded-lg text-indigo-600 focus:ring-4 focus:ring-indigo-500/20 focus:ring-offset-0 transition-all cursor-pointer"
                        >
                        <label for="remember" class="ml-3 text-sm font-bold text-slate-500 cursor-pointer hover:text-slate-700 transition-colors">
                            Maintain Session
                        </label>
                    </div>
                    <a href="#" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors">
                        Recover Key
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full px-8 py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black shadow-xl shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center space-x-3"
                >
                    <span class="text-lg tracking-tight">Establish Handshake</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-10">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-6 bg-white text-slate-400 font-bold uppercase tracking-[0.2em]">New Entity?</span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <a href="{{ route('register') }}" class="group inline-flex items-center space-x-2 text-sm font-black text-indigo-600 hover:text-indigo-700 transition-colors">
                    <span>Initiate Registration</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="mt-10 text-center">
            <div class="inline-flex items-center space-x-3 bg-white px-5 py-2.5 rounded-full text-[10px] font-black text-slate-400 border border-slate-100 shadow-sm uppercase tracking-widest">
                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>End-to-End Encryption Active</span>
            </div>
        </div>
    </div>
</div>
@endsection
