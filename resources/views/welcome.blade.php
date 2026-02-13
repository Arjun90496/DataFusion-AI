@extends('layouts.layout')

@section('content')
<!-- Main Landing Page -->
<div class="gradient-bg min-h-screen">

    <!-- Navigation Bar -->
    <nav class="glass fixed top-0 left-0 right-0 z-50 border-b border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/50">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold gradient-text">DataFusion AI</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">Features</a>
                    <a href="#how-it-works" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">How It Works</a>
                    <a href="#pricing" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">Pricing</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition-colors duration-200">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 hover:scale-105">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center space-y-8 animate-fade-in">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 glass px-4 py-2 rounded-full text-sm text-indigo-300 border border-indigo-500/30">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span>AI-Powered Data Integration Platform</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-5xl md:text-7xl font-bold leading-tight">
                    <span class="gradient-text">Fuse Multiple APIs</span><br>
                    <span class="text-slate-100">Into Powerful Insights</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
                    Connect any API, combine data from multiple sources, and let AI generate actionable insights. 
                    Build your data empire in minutes, not months.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="{{ route('register') }}" class="group px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-2xl shadow-indigo-500/40 hover:shadow-indigo-500/60 transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                        <span>Start Free Trial</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#how-it-works" class="px-8 py-4 glass border border-slate-700 hover:border-indigo-500/50 text-slate-300 rounded-xl font-semibold transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Watch Demo</span>
                    </a>
                </div>

                <!-- Social Proof -->
                <div class="pt-8 flex items-center justify-center space-x-8 text-slate-500 text-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>No credit card required</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Cancel anytime</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-4">
                    Powerful Features for <span class="gradient-text">Data Fusion</span>
                </h2>
                <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                    Everything you need to integrate, analyze, and gain insights from multiple data sources
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1: Multi-API Integration -->
                <div class="group glass p-8 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-indigo-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-500/20 transition-colors">
                        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">Multi-API Integration</h3>
                    <p class="text-slate-400 leading-relaxed">Connect to weather, news, social media, and any REST API. Store your keys securely and manage all connections in one place.</p>
                </div>

                <!-- Feature 2: Smart Data Fusion -->
                <div class="group glass p-8 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-purple-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-purple-500/20 transition-colors">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">Smart Data Fusion</h3>
                    <p class="text-slate-400 leading-relaxed">Automatically combine data from multiple sources. Cross-reference, correlate, and merge information into unified datasets.</p>
                </div>

                <!-- Feature 3: AI-Powered Insights -->
                <div class="group glass p-8 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-pink-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-pink-500/20 transition-colors">
                        <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">AI-Powered Insights</h3>
                    <p class="text-slate-400 leading-relaxed">Let AI analyze your fused data and generate actionable insights, predictions, and recommendations automatically.</p>
                </div>

                <!-- Feature 4: Real-time Updates -->
                <div class="group glass p-8 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-cyan-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">Real-time Updates</h3>
                    <p class="text-slate-400 leading-relaxed">Fetch fresh data on-demand or schedule automatic updates. Always work with the latest information from your sources.</p>
                </div>

                <!-- Feature 5: Secure Storage -->
                <div class="group glass p-8 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-500/20 transition-colors">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">Secure Storage</h3>
                    <p class="text-slate-400 leading-relaxed">Your API keys and data are encrypted at rest. Industry-standard security practices protect your sensitive information.</p>
                </div>

                <!-- Feature 6: Export & Share -->
                <div class="group glass p-8 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-amber-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-amber-500/20 transition-colors">
                        <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">Export & Share</h3>
                    <p class="text-slate-400 leading-relaxed">Download your fused data and insights in CSV or JSON format. Integrate with your existing workflows seamlessly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-900/30">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-4">
                    How It <span class="gradient-text">Works</span>
                </h2>
                <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                    Get started in three simple steps
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="glass p-8 rounded-2xl border border-slate-800 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-indigo-500/50">
                            <span class="text-3xl font-bold text-white">1</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-100 mb-3">Connect APIs</h3>
                        <p class="text-slate-400">Add your API keys for services like OpenAI, weather APIs, news feeds, and more. All securely encrypted.</p>
                    </div>
                    <div class="hidden md:block absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2">
                        <svg class="w-8 h-8 text-indigo-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="glass p-8 rounded-2xl border border-slate-800 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/50">
                            <span class="text-3xl font-bold text-white">2</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-100 mb-3">Fuse Data</h3>
                        <p class="text-slate-400">Our engine fetches and combines data from multiple sources, creating unified datasets with rich context.</p>
                    </div>
                    <div class="hidden md:block absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2">
                        <svg class="w-8 h-8 text-indigo-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="glass p-8 rounded-2xl border border-slate-800 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-pink-500/50">
                        <span class="text-3xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-3">Get Insights</h3>
                    <p class="text-slate-400">AI analyzes your combined data and generates actionable insights, trends, and recommendations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-4">
                    Simple, <span class="gradient-text">Transparent</span> Pricing
                </h2>
                <p class="text-xl text-slate-400">
                    Start free, upgrade when you need more power
                </p>
            </div>

            <div class="glass p-10 rounded-3xl border border-slate-800 shadow-2xl shadow-indigo-500/10">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-slate-100 mb-2">Free Forever</h3>
                    <p class="text-slate-400">Perfect for getting started</p>
                </div>

                <div class="text-center mb-8">
                    <div class="flex items-baseline justify-center space-x-2">
                        <span class="text-6xl font-bold gradient-text">$0</span>
                        <span class="text-slate-400 text-xl">/month</span>
                    </div>
                </div>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-slate-300">Up to 5 API connections</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-slate-300">100 data fusion requests/month</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-slate-300">10 AI insights/month</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-slate-300">Export to CSV & JSON</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-slate-300">Community support</span>
                    </li>
                </ul>

                <a href="{{ route('register') }}" class="block w-full px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-center rounded-xl font-semibold shadow-lg shadow-indigo-500/40 hover:shadow-indigo-500/60 transition-all duration-300 hover:scale-105">
                    Start Free Now
                </a>

                <p class="text-center text-slate-500 text-sm mt-4">No credit card required • Cancel anytime</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <div class="glass p-12 rounded-3xl border border-slate-800 shadow-2xl shadow-indigo-500/10">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-6">
                    Ready to <span class="gradient-text">Transform</span> Your Data?
                </h2>
                <p class="text-xl text-slate-400 mb-8 max-w-2xl mx-auto">
                    Join thousands of teams using DataFusion AI to unlock insights from their data sources.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-lg shadow-indigo-500/40 hover:shadow-indigo-500/60 transition-all duration-300 hover:scale-105">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 glass border border-slate-700 hover:border-indigo-500/50 text-slate-300 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-800/50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold gradient-text">DataFusion AI</span>
                    </div>
                    <p class="text-slate-400 text-sm">Intelligent data integration for modern teams.</p>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="font-semibold text-slate-100 mb-4">Product</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Features</a></li>
                        <li><a href="#pricing" class="hover:text-indigo-400 transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">API Documentation</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-semibold text-slate-100 mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Careers</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="font-semibold text-slate-100 mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800/50 text-center text-sm text-slate-500">
                <p>&copy; {{ date('Y') }} DataFusion AI. All rights reserved. Built with Laravel & Tailwind CSS.</p>
            </div>
        </div>
    </footer>

</div>
@endsection
