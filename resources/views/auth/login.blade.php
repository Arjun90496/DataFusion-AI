@extends('layouts.layout')

@section('content')
<div class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full animate-fade-in">
        
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <a href="{{ route('login') }}" class="inline-block">
                <div class="inline-flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/50">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold gradient-text">DataFusion AI</span>
                </div>
            </a>
            <p class="text-slate-400">Sign in to your account</p>
        </div>

        <!-- Login Card -->
        <div class="glass p-8 rounded-2xl border border-slate-800 shadow-2xl shadow-indigo-500/10">
            <h2 class="text-2xl font-bold text-slate-100 text-center mb-6">Welcome Back</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 text-slate-100 rounded-lg placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('email') border-red-500 ring-2 ring-red-500/50 @enderror"
                            placeholder="john@example.com"
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
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full pl-10 pr-4 py-3 bg-slate-900/50 border border-slate-700 text-slate-100 rounded-lg placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('password') border-red-500 ring-2 ring-red-500/50 @enderror"
                            placeholder="Enter your password"
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="w-4 h-4 bg-slate-900/50 border-slate-700 rounded text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0"
                        >
                        <label for="remember" class="ml-2 text-sm text-slate-300">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/40 hover:shadow-indigo-500/60 transition-all duration-300 hover:scale-105 flex items-center justify-center space-x-2"
                >
                    <span>Sign In</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-800"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-slate-900 text-slate-500">New to DataFusion AI?</span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-slate-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition-colors ml-1">
                        Create one now →
                    </a>
                </p>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="mt-6 text-center">
            <div class="inline-flex items-center space-x-2 glass px-4 py-2 rounded-full text-xs text-slate-400 border border-slate-800/50">
                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Secured with industry-standard encryption</span>
            </div>
        </div>
    </div>
</div>
@endsection
