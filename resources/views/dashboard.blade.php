@extends('layouts.layout')

@section('content')
<div class="gradient-bg min-h-screen">
    
    <!-- Main Container with Sidebar -->
    <div class="flex">
        
        <!-- Sidebar Navigation -->
        <aside class="fixed left-0 top-0 h-screen w-64 glass border-r border-slate-200 z-40">
            <div class="flex flex-col h-full text-slate-700">
                <!-- Logo -->
                <div class="p-6 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-lg font-bold gradient-text">DataFusion AI</span>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="p-6 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold shadow-md">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-700 transition-colors shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-semibold">Dashboard</span>
                    </a>

                    <!-- API Keys -->
                    <a href="{{ route('api-keys.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50 transition-colors group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span class="font-medium">API Keys</span>
                    </a>

                    <!-- Data Fusion -->
                    <a href="{{ route('fusion.show') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50 transition-colors group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                        </svg>
                        <span class="font-medium">Data Fusion</span>
                        <span class="ml-auto text-xs bg-indigo-100 text-indigo-700 font-bold px-2 py-1 rounded-full">Phase 6</span>
                    </a>

                    <!-- AI Insights -->
                    <a href="{{ route('insights.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50 transition-colors group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <span class="font-medium">AI Insights</span>
                        <span class="ml-auto text-xs bg-purple-100 text-purple-700 font-bold px-2 py-1 rounded-full">Phase 7</span>
                    </a>

                    <!-- Divider -->
                    <div class="pt-4 pb-2">
                        <div class="border-t border-slate-100"></div>
                    </div>

                    <!-- Settings -->
                    <a href="{{ route('settings.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50 transition-colors group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="p-4 border-t border-slate-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-semibold">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 ml-64 bg-slate-50/50 min-h-screen">
            <!-- Top Navigation Bar -->
            <nav class="glass border-b border-slate-200 sticky top-0 z-30">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dashboard</h1>
                        <p class="text-sm font-medium text-slate-500">Welcome back, {{ $user->name }}</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-64 pl-10 pr-4 py-2 bg-white border border-slate-200 text-slate-900 rounded-xl text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition shadow-sm">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Notifications -->
                        <button class="relative p-2 text-slate-400 hover:text-indigo-600 rounded-xl hover:bg-indigo-50 transition-colors shadow-sm bg-white border border-slate-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-indigo-500 border-2 border-white rounded-full"></span>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <div class="p-8 space-y-8">
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- API Keys Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-200 hover:border-indigo-500/50 transition-all duration-300 group shadow-sm hover:shadow-md bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-indigo-50 rounded-xl group-hover:bg-indigo-100 transition-colors">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['api_count'] }}</span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Connected APIs</h3>
                        <p class="text-xs text-slate-400">Active integrations</p>
                    </div>

                    <!-- Data Fetches Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/50 transition-all duration-300 group shadow-sm hover:shadow-md bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-emerald-50 rounded-xl group-hover:bg-emerald-100 transition-colors">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['total_fetches'] }}</span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Total Fetches</h3>
                        <p class="text-xs text-slate-400">Requests processed</p>
                    </div>

                    <!-- AI Insights Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-200 hover:border-purple-500/50 transition-all duration-300 group shadow-sm hover:shadow-md bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-purple-50 rounded-xl group-hover:bg-purple-100 transition-colors">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['insights_count'] }}</span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">AI Insights</h3>
                        <p class="text-xs text-slate-400">Generated insights</p>
                    </div>

                    <!-- Storage Used Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-200 hover:border-amber-500/50 transition-all duration-300 group shadow-sm hover:shadow-md bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-amber-50 rounded-xl group-hover:bg-amber-100 transition-colors">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['storage_used'] }}<span class="text-base text-slate-400 font-medium ml-1">MB</span></span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Storage Used</h3>
                        <p class="text-xs text-slate-400">Of 1GB available</p>
                    </div>
                </div>

                <!-- Connected APIs Section -->
                <div class="glass p-8 rounded-2xl border border-slate-200 bg-white/50 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Connected APIs</h2>
                            <p class="text-sm font-medium text-slate-500">Manage your API integrations and fetch data</p>
                        </div>
                        <a href="{{ route('api-keys.index') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/20 transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Add API</span>
                        </a>
                    </div>

                    @if(count($connectedApis) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($connectedApis as $api)
                                <div class="glass p-6 rounded-xl border border-slate-200 hover:border-{{ $api['color'] }}-500/50 transition-all duration-300 group bg-white shadow-sm hover:shadow-md">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-start space-x-4">
                                            <!-- API Icon -->
                                            <div class="p-3 bg-{{ $api['color'] }}-50 rounded-lg group-hover:bg-{{ $api['color'] }}-100 transition-colors">
                                                @if($api['icon'] == 'cloud')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                    </svg>
                                                @elseif($api['icon'] == 'newspaper')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                    </svg>
                                                @elseif($api['icon'] == 'sparkles')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                    </svg>
                                                @elseif($api['icon'] == 'code')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            
                                            <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 mb-1">{{ $api['name'] }}</h3>
                                                <p class="text-sm font-medium text-slate-500 mb-2 leading-relaxed">{{ $api['description'] }}</p>
                                                <p class="text-xs font-bold text-slate-400">Last sync: {{ $api['last_sync'] }}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Status Indicator -->
                                        <div class="flex flex-col items-end space-y-2">
                                            @if($api['status'] == 'online')
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-bold text-emerald-600">Online</span>
                                                    <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full shadow-lg shadow-emerald-500/20"></div>
                                                </div>
                                            @elseif($api['status'] == 'offline')
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-bold text-red-600">Offline</span>
                                                    <div class="w-2.5 h-2.5 bg-red-500 rounded-full shadow-lg shadow-red-500/20"></div>
                                                </div>
                                            @else
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-bold text-amber-600">Pending</span>
                                                    <div class="w-2.5 h-2.5 bg-amber-500 rounded-full animate-pulse shadow-lg shadow-amber-500/20"></div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- API Stats -->
                                    <div class="flex items-center justify-between mb-4 pt-4 border-t border-slate-100">
                                        <div class="text-center">
                                            <p class="text-2xl font-extrabold text-slate-900">{{ $api['fetch_count'] }}</p>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Fetches</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-2xl font-extrabold text-slate-900">{{ number_format($api['error_rate'] * 100, 1) }}%</p>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Error Rate</p>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex space-x-2">
                                        <button 
                                            onclick="fetchData({{ $api['id'] }}, this)"
                                            class="flex-1 px-4 py-2 bg-{{ $api['color'] }}-600 hover:bg-{{ $api['color'] }}-700 text-white rounded-xl font-bold transition-all duration-300 hover:scale-105 flex items-center justify-center space-x-2 shadow-sm"
                                            @if($api['status'] == 'offline') disabled @endif
                                        >
                                            <svg class="w-4 h-4 spinner hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            <span class="button-text">Fetch Data</span>
                                        </button>
                                        <button class="px-4 py-2 glass border border-slate-200 hover:border-{{ $api['color'] }}-500/50 text-slate-500 hover:text-{{ $api['color'] }}-600 rounded-xl font-bold transition-all duration-300 bg-white">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-slate-300 mb-2">No APIs Connected</h3>
                            <p class="text-slate-500 mb-4">Add your first API to start fetching data</p>
                        </div>
                    @endif
                </div>

                <!-- Two Column Layout for AI Insights and Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <!-- AI Insights Section -->
                    <div class="glass p-8 rounded-2xl border border-slate-200 bg-white/50 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">AI Insights</h2>
                                <p class="text-sm font-medium text-slate-500">Recommendations and patterns</p>
                            </div>
                            <span class="text-xs bg-purple-100 text-purple-700 font-bold px-3 py-1 rounded-full">Phase 7</span>
                        </div>

                        @if(count($aiInsights) > 0)
                            <div class="space-y-4">
                                @foreach($aiInsights as $insight)
                                    <div class="glass p-5 rounded-xl border border-slate-100 hover:border-purple-200 transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                                        <div class="flex items-start space-x-4">
                                            <!-- Icon based on severity -->
                                            <div class="p-3 
                                                @if($insight['severity'] == 'warning') bg-amber-50 
                                                @elseif($insight['severity'] == 'success') bg-emerald-50 
                                                @else bg-purple-50 
                                                @endif 
                                                rounded-lg flex-shrink-0">
                                                <svg class="w-5 h-5 
                                                    @if($insight['severity'] == 'warning') text-amber-600 
                                                    @elseif($insight['severity'] == 'success') text-emerald-600 
                                                    @else text-purple-600 
                                                    @endif" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($insight['icon'] == 'chart-line')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                                    @elseif($insight['icon'] == 'exclamation-triangle')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    @endif
                                                </svg>
                                            </div>
                                            
                                            <div class="flex-1">
                                                <div class="flex items-start justify-between mb-2">
                                                    <h4 class="font-bold text-slate-900">{{ $insight['title'] }}</h4>
                                                    <span class="text-xs font-bold
                                                        @if($insight['severity'] == 'warning') bg-amber-100 text-amber-700 
                                                        @elseif($insight['severity'] == 'success') bg-emerald-100 text-emerald-700 
                                                        @else bg-purple-100 text-purple-700 
                                                        @endif 
                                                        px-2 py-1 rounded-lg capitalize">{{ $insight['severity'] }}</span>
                                                </div>
                                                <p class="text-sm font-medium text-slate-500 mb-3 leading-relaxed">{{ $insight['description'] }}</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs font-bold text-slate-400">{{ $insight['created_at'] }}</span>
                                                    <button class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                                                        {{ $insight['action'] }} →
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <p class="text-slate-500">No insights generated yet</p>
                            </div>
                        @endif
                    </div>

                    <!-- Recent Activity Section -->
                    <div class="glass p-8 rounded-2xl border border-slate-200 bg-white/50 shadow-sm">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Recent Activity</h2>
                            <p class="text-sm font-medium text-slate-500">Your latest actions and events</p>
                        </div>

                        @if(count($recentActivity) > 0)
                            <div class="space-y-4">
                                @foreach($recentActivity as $activity)
                                    <div class="flex items-start space-x-4 p-3 bg-white/50 rounded-xl hover:bg-white transition-colors">
                                        <div class="p-2 bg-{{ $activity['color'] }}-50 rounded-lg flex-shrink-0">
                                            <svg class="w-5 h-5 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($activity['icon'] == 'download')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                @elseif($activity['icon'] == 'lightbulb')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                @elseif($activity['icon'] == 'plus-circle')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                @endif
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-slate-700">{{ $activity['description'] }}</p>
                                            <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-tighter">{{ $activity['timestamp'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-slate-500 py-8">No recent activity</p>
                        @endif
                    </div>
                </div>

                @if($latestFusion)
                    <!-- Latest Fusion Summary -->
                    <div class="glass p-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Latest Data Fusion</h2>
                            <a href="{{ route('fusion.show') }}" class="text-indigo-600 hover:text-indigo-700 transition-colors text-sm font-bold">View Full Details →</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Weather Summary -->
                            @if($latestFusion->weather)
                                <div class="bg-indigo-50/30 p-6 rounded-2xl border border-indigo-100/50">
                                    <div class="flex items-center space-x-3 mb-4 text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                        </svg>
                                        <span class="font-extrabold uppercase tracking-widest text-xs">Environment</span>
                                    </div>
                                    <p class="text-3xl font-extrabold text-slate-900 mb-1">{{ $latestFusion->weather['data']['current']['temperature'] ?? 'N/A' }}°C</p>
                                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter">{{ $latestFusion->weather['data']['weather']['description'] ?? 'N/A' }}</p>
                                </div>
                            @endif

                            <!-- Crypto Summary -->
                            @if($latestFusion->crypto)
                                <div class="bg-emerald-50/30 p-6 rounded-2xl border border-emerald-100/50">
                                    <div class="flex items-center space-x-3 mb-4 text-emerald-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-extrabold uppercase tracking-widest text-xs">Markets (BTC)</span>
                                    </div>
                                    @php $btc = collect($latestFusion->crypto['data']['data'])->where('id', 'bitcoin')->first(); @endphp
                                    <p class="text-3xl font-extrabold text-slate-900 mb-1">${{ number_format($btc['current_price'] ?? 0, 0) }}</p>
                                    <p class="text-sm font-bold {{ ($btc['change_24h'] ?? 0) >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                        {{ ($btc['change_24h'] ?? 0) >= 0 ? '+' : '' }}{{ number_format($btc['change_24h'] ?? 0, 2) }}% (24h)
                                    </p>
                                </div>
                            @endif

                            <!-- News Summary -->
                            @if($latestFusion->news)
                                <div class="bg-blue-50/30 p-6 rounded-2xl border border-blue-100/50">
                                    <div class="flex items-center space-x-3 mb-4 text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                        <span class="font-extrabold uppercase tracking-widest text-xs">Latest Briefing</span>
                                    </div>
                                    <p class="text-sm font-bold text-slate-800 line-clamp-2 mb-2 leading-tight">{{ $latestFusion->news['data']['articles'][0]['title'] ?? 'No news updates' }}</p>
                                    <p class="text-xs font-bold text-slate-400 tracking-tight">{{ $latestFusion->news['data']['articles'][0]['source']['name'] ?? 'Unknown' }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Data Visualization Placeholder (when no data exists) -->
                    <div class="glass p-12 rounded-2xl border-2 border-dashed border-slate-200 text-center bg-white/50 shadow-sm">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 tracking-tight">No Fusion Data Visualization</h3>
                        <p class="text-slate-500 mb-8 max-w-xl mx-auto font-medium leading-relaxed">
                            Generate your first data fusion snapshot to see a live visual summary of your ecosystem data here.
                        </p>
                        <form action="{{ route('fusion.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95">
                                Generate Fusion Snapshot
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </main>
    </div>
</div>

<!-- Fetch Data JavaScript -->
<script>
    /**
     * Simulate data fetching with loading states
     * In Phase 5, this will make actual API calls to backend
     */
    async function fetchData(apiId, button) {
        const spinner = button.querySelector('.spinner');
        const buttonText = button.querySelector('.button-text');
        
        // Show loading state
        button.disabled = true;
        spinner.classList.remove('hidden');
        spinner.classList.add('animate-spin');
        buttonText.textContent = 'Fetching...';
        
        try {
            const response = await fetch(`/api-keys/${apiId}/fetch`);
            const data = await response.json();
            
            if (data.success) {
                // Show success state
                buttonText.textContent = 'Success!';
                button.classList.add('bg-emerald-600');
                
                // Refresh to show new data/activity
                setTimeout(() => window.location.reload(), 1500);
            } else {
                buttonText.textContent = 'Failed';
                button.classList.add('bg-red-600');
                showToast(`Failed to fetch: ${data.message}`, 'error');
                
                setTimeout(() => {
                    button.disabled = false;
                    buttonText.textContent = 'Fetch Data';
                    button.classList.remove('bg-red-600');
                }, 2000);
            }
        } catch (error) {
            console.error('Fetch error:', error);
            buttonText.textContent = 'Error';
            button.classList.add('bg-red-600');
            
            setTimeout(() => {
                button.disabled = false;
                buttonText.textContent = 'Fetch Data';
                button.classList.remove('bg-red-600');
            }, 2000);
        } finally {
            spinner.classList.add('hidden');
            spinner.classList.remove('animate-spin');
        }
    }
</script>
@endsection
