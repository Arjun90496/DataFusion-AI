@extends('layouts.layout')

@section('content')
<!-- Main Landing Page -->
<div class="gradient-bg min-h-screen">

    <!-- Navigation Bar -->
    <nav class="glass fixed top-0 left-0 right-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-xl shadow-indigo-500/10 border border-slate-100 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-slate-900 tracking-tight">DataFusion AI</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="#features" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Capabilities</a>
                    <a href="#how-it-works" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Methodology</a>
                    <a href="#pricing" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Investment</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors">
                        Member Portal
                    </a>
                    <a href="{{ route('register') }}" class="px-7 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-xl shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95">
                        Initiate Access
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
                <div class="inline-flex items-center space-x-3 bg-white px-5 py-2.5 rounded-full text-xs font-black text-indigo-600 border border-indigo-100 shadow-sm uppercase tracking-widest">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span>Intelligent Intelligence Repository</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-6xl md:text-8xl font-black leading-[1.1] tracking-tighter">
                    <span class="text-slate-900">Fuse Your Data.</span><br>
                    <span class="gradient-text">Unlock The AI.</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-xl md:text-2xl text-slate-500 font-medium max-w-4xl mx-auto leading-relaxed">
                    DataFusion AI seamlessly orchestrates your disparate API sources into a unified intelligence engine. 
                    Accelerate your decision-making with multi-modal analysis in real-time.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-6">
                    <a href="{{ route('register') }}" class="group px-10 py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black shadow-2xl shadow-indigo-500/30 transition-all hover:scale-105 active:scale-95 flex items-center space-x-4">
                        <span>Deploy Your Workspace</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#how-it-works" class="px-10 py-5 bg-white border border-slate-200 text-slate-700 rounded-2xl font-black shadow-sm hover:bg-slate-50 transition-all hover:scale-105 flex items-center space-x-4">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        </svg>
                        <span>System Walkthrough</span>
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
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 tracking-tight">
                    Engineered for <span class="gradient-text">Precision.</span>
                </h2>
                <p class="text-xl text-slate-500 font-medium max-w-2xl mx-auto">
                    Advanced analytical capabilities designed for high-stakes decision environments.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Feature 1: Multi-API Integration -->
                <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-200 hover:border-indigo-200 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/5 hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-2xl -mr-16 -mt-16 group-hover:bg-indigo-500/10 transition-colors"></div>
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 border border-slate-100 group-hover:scale-110 group-hover:bg-indigo-50 transition-all duration-500">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Multi-Node Fusion</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Seamlessly connect to global data streams. Orchestrate multiple providers behind our secure encryption layer.</p>
                </div>

                <!-- Feature 2: Smart Data Fusion -->
                <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-200 hover:border-purple-200 transition-all duration-500 hover:shadow-2xl hover:shadow-purple-500/5 hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/5 rounded-full blur-2xl -mr-16 -mt-16 group-hover:bg-purple-500/10 transition-colors"></div>
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 border border-slate-100 group-hover:scale-110 group-hover:bg-purple-50 transition-all duration-500">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Structured Synthesis</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Aggregate disparate data points into high-fidelity snapshots. Automated correlation identifies patterns instantly.</p>
                </div>

                <!-- Feature 3: AI-Powered Insights -->
                <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-200 hover:border-pink-200 transition-all duration-500 hover:shadow-2xl hover:shadow-pink-500/5 hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-pink-500/5 rounded-full blur-2xl -mr-16 -mt-16 group-hover:bg-pink-500/10 transition-colors"></div>
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 border border-slate-100 group-hover:scale-110 group-hover:bg-pink-50 transition-all duration-500">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Strategic Intelligence</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Deploy advanced AI models to interpret your data fusion. Receive tailored recommendations and market predictions.</p>
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 text-center shadow-sm group">
                    <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-inner border border-indigo-100 group-hover:scale-110 transition-transform duration-500">
                        <span class="text-3xl font-black text-indigo-600">01</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Identity Linking</h3>
                    <p class="text-slate-500 font-medium">Link your secure API nodes via our encrypted handshake protocol. Total data sovereignty maintained.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 text-center shadow-sm group">
                    <div class="w-20 h-20 bg-purple-50 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-inner border border-purple-100 group-hover:scale-110 transition-transform duration-500">
                        <span class="text-3xl font-black text-purple-600">02</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Node Fusion</h3>
                    <p class="text-slate-500 font-medium">Our engine synthesizes concurrent streams into a high-dimensional intelligence snapshot.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 text-center shadow-sm group">
                    <div class="w-20 h-20 bg-pink-50 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-inner border border-pink-100 group-hover:scale-110 transition-transform duration-500">
                        <span class="text-3xl font-black text-pink-600">03</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Deep Analysis</h3>
                    <p class="text-slate-500 font-medium">AI models execute deep-learning scans on fused data to generate predictive intelligence reports.</p>
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

            <div class="bg-white p-12 rounded-[3.5rem] border border-slate-200 shadow-2xl shadow-indigo-500/5 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>
                
                <div class="text-center mb-10 relative z-10">
                    <h3 class="text-4xl font-black text-slate-900 mb-3 tracking-tight">Open Architecture</h3>
                    <p class="text-slate-500 font-medium">Unrestricted access to the fusion engine during the beta phase.</p>
                </div>

                <div class="text-center mb-12 relative z-10">
                    <div class="flex items-baseline justify-center space-x-3">
                        <span class="text-8xl font-black text-slate-900 tracking-tighter">$0</span>
                        <span class="text-slate-400 font-bold text-xl uppercase tracking-widest">/ Term</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 relative z-10">
                    <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-white hover:border-indigo-100 transition-all">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-slate-700 font-bold">Infinite Node Connections</span>
                    </div>
                    <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-white hover:border-indigo-100 transition-all">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-slate-700 font-bold">Uncapped Data Streams</span>
                    </div>
                </div>

                <a href="{{ route('register') }}" class="block w-full px-10 py-6 bg-indigo-600 hover:bg-indigo-700 text-white text-center rounded-[2rem] font-black text-xl shadow-xl shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-95 relative z-10">
                    Begin Strategic Deployment
                </a>

                <p class="text-center text-slate-400 font-bold text-xs uppercase tracking-[0.2em] mt-8 relative z-10">Zero Friction Onboarding • No Token Commitment Required</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto text-center">
            <div class="bg-indigo-600 p-16 rounded-[4rem] shadow-2xl shadow-indigo-500/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -mr-48 -mt-48 transition-transform duration-700 group-hover:scale-110"></div>
                
                <h2 class="text-5xl md:text-6xl font-black text-white mb-8 relative z-10 tracking-tight">
                    Scale Your Intelligence.
                </h2>
                <p class="text-xl text-indigo-100 font-medium mb-12 max-w-2xl mx-auto relative z-10">
                    Integrate your first node in under 60 seconds and witness the power of synthesized data.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 relative z-10">
                    <a href="{{ route('register') }}" class="px-12 py-5 bg-white text-indigo-600 rounded-2xl font-black text-lg shadow-xl hover:scale-105 active:scale-95 transition-all">
                        Initiate Free Workspace
                    </a>
                    <a href="{{ route('login') }}" class="px-12 py-5 bg-indigo-500/50 text-white border border-indigo-400/30 rounded-2xl font-black text-lg backdrop-blur-sm hover:bg-indigo-500 transition-all">
                        Member Portal
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-100 py-20 px-4 sm:px-6 lg:px-8 bg-white/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-16">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-xl border border-slate-100">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-black text-slate-900 tracking-tight">DataFusion</span>
                    </div>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed">Pioneering multi-node data synthesis for advanced decision intelligence.</p>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Capabilities</h4>
                    <ul class="space-y-4 text-sm font-bold text-slate-600">
                        <li><a href="#features" class="hover:text-indigo-600 transition-colors">Core Engine</a></li>
                        <li><a href="#pricing" class="hover:text-indigo-600 transition-colors">Node Access</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Security Protocol</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Entity</h4>
                    <ul class="space-y-4 text-sm font-bold text-slate-600">
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Mission Control</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Intelligence Blog</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Careers</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Compliance</h4>
                    <ul class="space-y-4 text-sm font-bold text-slate-600">
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Data Privacy</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Service Level</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Governance</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-12 border-t border-slate-100 text-center">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">&copy; {{ date('Y') }} DataFusion Systems. All rights reserved.</p>
            </div>
        </div>
    </footer>

</div>
@endsection
