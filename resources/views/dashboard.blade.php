@extends('layouts.layout')

@section('content')
<div class="gradient-bg min-h-screen">
    
    <!-- Main Container with Sidebar -->
    <div class="flex">
        
        <!-- Sidebar Navigation -->
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
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-200 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-indigo-600/20 border border-indigo-500/50 text-indigo-300 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- API Keys -->
                    <a href="{{ route('api-keys.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span class="font-medium">API Keys</span>
                    </a>

                    <!-- Data Fusion -->
                    <a href="{{ route('fusion.show') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                        </svg>
                        <span class="font-medium">Data Fusion</span>
                    </a>

                    <!-- AI Insights -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <span class="font-medium">AI Insights</span>
                        <span class="ml-auto text-xs bg-pink-500/20 text-pink-300 px-2 py-1 rounded-full">Phase 7</span>
                    </a>

                    <!-- Divider -->
                    <div class="pt-4 pb-2">
                        <div class="border-t border-slate-800"></div>
                    </div>

                    <!-- Settings -->
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
                        <h1 class="text-2xl font-bold text-slate-100">Dashboard</h1>
                        <p class="text-sm text-slate-400">Welcome back, {{ $user->name }}</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-64 pl-10 pr-4 py-2 bg-slate-900/50 border border-slate-700 text-slate-100 rounded-lg text-sm placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            <svg class="w-5 h-5 text-slate-500 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Notifications -->
                        <button class="relative p-2 text-slate-400 hover:text-slate-200 rounded-lg hover:bg-slate-800/50 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <div class="p-8 space-y-8">
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- API Keys Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-indigo-500/10 rounded-xl group-hover:bg-indigo-500/20 transition-colors">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-100">{{ $stats['api_count'] }}</span>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wide mb-1">Connected APIs</h3>
                        <p class="text-xs text-slate-600">Active integrations</p>
                    </div>

                    <!-- Data Fetches Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-800 hover:border-emerald-500/50 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-emerald-500/10 rounded-xl group-hover:bg-emerald-500/20 transition-colors">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-100">{{ $stats['total_fetches'] }}</span>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wide mb-1">Total Fetches</h3>
                        <p class="text-xs text-slate-600">Requests processed</p>
                    </div>

                    <!-- AI Insights Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-800 hover:border-purple-500/50 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-purple-500/10 rounded-xl group-hover:bg-purple-500/20 transition-colors">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-100">{{ $stats['insights_count'] }}</span>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wide mb-1">AI Insights</h3>
                        <p class="text-xs text-slate-600">Generated insights</p>
                    </div>

                    <!-- Storage Used Card -->
                    <div class="glass p-6 rounded-2xl border border-slate-800 hover:border-amber-500/50 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-amber-500/10 rounded-xl group-hover:bg-amber-500/20 transition-colors">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-100">{{ $stats['storage_used'] }}<span class="text-base text-slate-500">MB</span></span>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wide mb-1">Storage Used</h3>
                        <p class="text-xs text-slate-600">Of 1GB available</p>
                    </div>
                </div>

                <!-- Connected APIs Section -->
                <div class="glass p-8 rounded-2xl border border-slate-800">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-100">Connected APIs</h2>
                            <p class="text-sm text-slate-400">Manage your API integrations and fetch data</p>
                        </div>
                        <a href="{{ route('api-keys.index') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/30 transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Add API</span>
                        </a>
                    </div>

                    @if(count($connectedApis) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($connectedApis as $api)
                                <div class="glass p-6 rounded-xl border border-slate-700 hover:border-{{ $api['color'] }}-500/50 transition-all duration-300 group">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-start space-x-4">
                                            <!-- API Icon -->
                                            <div class="p-3 bg-{{ $api['color'] }}-500/10 rounded-lg group-hover:bg-{{ $api['color'] }}-500/20 transition-colors">
                                                @if($api['icon'] == 'cloud')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                    </svg>
                                                @elseif($api['icon'] == 'newspaper')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                    </svg>
                                                @elseif($api['icon'] == 'sparkles')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                    </svg>
                                                @elseif($api['icon'] == 'code')
                                                    <svg class="w-6 h-6 text-{{ $api['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            
                                            <div class="flex-1">
                                                <h3 class="font-bold text-slate-100 mb-1">{{ $api['name'] }}</h3>
                                                <p class="text-sm text-slate-400 mb-2">{{ $api['description'] }}</p>
                                                <p class="text-xs text-slate-500">Last sync: {{ $api['last_sync'] }}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Status Indicator -->
                                        <div class="flex flex-col items-end space-y-2">
                                            @if($api['status'] == 'online')
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-medium text-emerald-400">Online</span>
                                                    <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                                                </div>
                                            @elseif($api['status'] == 'offline')
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-medium text-red-400">Offline</span>
                                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                                </div>
                                            @else
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-medium text-amber-400">Pending</span>
                                                    <div class="w-3 h-3 bg-amber-500 rounded-full animate-pulse"></div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- API Stats -->
                                    <div class="flex items-center justify-between mb-4 pt-4 border-t border-slate-700">
                                        <div class="text-center">
                                            <p class="text-2xl font-bold text-slate-100">{{ $api['fetch_count'] }}</p>
                                            <p class="text-xs text-slate-500">Fetches</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-2xl font-bold text-slate-100">{{ number_format($api['error_rate'] * 100, 1) }}%</p>
                                            <p class="text-xs text-slate-500">Error Rate</p>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex space-x-2">
                                        <button 
                                            onclick="fetchData({{ $api['id'] }}, this)"
                                            class="flex-1 px-4 py-2 bg-{{ $api['color'] }}-600 hover:bg-{{ $api['color'] }}-700 text-white rounded-lg font-semibold transition-all duration-300 hover:scale-105 flex items-center justify-center space-x-2"
                                            @if($api['status'] == 'offline') disabled @endif
                                        >
                                            <svg class="w-4 h-4 spinner hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            <span class="button-text">Fetch Data</span>
                                        </button>
                                        <button class="px-4 py-2 glass border border-slate-700 hover:border-{{ $api['color'] }}-500/50 text-slate-300 rounded-lg font-semibold transition-all duration-300">
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
                    <div class="glass p-8 rounded-2xl border border-slate-800">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-100">AI Insights</h2>
                                <p class="text-sm text-slate-400">Recommendations and patterns</p>
                            </div>
                            <span class="text-xs bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full">Phase 7</span>
                        </div>

                        @if(count($aiInsights) > 0)
                            <div class="space-y-4">
                                @foreach($aiInsights as $insight)
                                    <div class="glass p-5 rounded-xl border border-slate-700 hover:border-purple-500/50 transition-all duration-300">
                                        <div class="flex items-start space-x-4">
                                            <!-- Icon based on severity -->
                                            <div class="p-3 
                                                @if($insight['severity'] == 'warning') bg-amber-500/10 
                                                @elseif($insight['severity'] == 'success') bg-emerald-500/10 
                                                @else bg-purple-500/10 
                                                @endif 
                                                rounded-lg flex-shrink-0">
                                                <svg class="w-5 h-5 
                                                    @if($insight['severity'] == 'warning') text-amber-400 
                                                    @elseif($insight['severity'] == 'success') text-emerald-400 
                                                    @else text-purple-400 
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
                                                    <h4 class="font-semibold text-slate-100">{{ $insight['title'] }}</h4>
                                                    <span class="text-xs 
                                                        @if($insight['severity'] == 'warning') bg-amber-500/20 text-amber-300 
                                                        @elseif($insight['severity'] == 'success') bg-emerald-500/20 text-emerald-300 
                                                        @else bg-purple-500/20 text-purple-300 
                                                        @endif 
                                                        px-2 py-1 rounded capitalize">{{ $insight['severity'] }}</span>
                                                </div>
                                                <p class="text-sm text-slate-400 mb-3">{{ $insight['description'] }}</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs text-slate-600">{{ $insight['created_at'] }}</span>
                                                    <button class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors">
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
                    <div class="glass p-8 rounded-2xl border border-slate-800">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-slate-100">Recent Activity</h2>
                            <p class="text-sm text-slate-400">Your latest actions and events</p>
                        </div>

                        @if(count($recentActivity) > 0)
                            <div class="space-y-4">
                                @foreach($recentActivity as $activity)
                                    <div class="flex items-start space-x-4">
                                        <div class="p-2 bg-{{ $activity['color'] }}-500/10 rounded-lg flex-shrink-0">
                                            <svg class="w-5 h-5 text-{{ $activity['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                            <p class="text-sm text-slate-300">{{ $activity['description'] }}</p>
                                            <p class="text-xs text-slate-600 mt-1">{{ $activity['timestamp'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-slate-500 py-8">No recent activity</p>
                        @endif
                    </div>
                </div>

                <!-- Data Visualization Placeholder -->
                <div class="glass p-12 rounded-2xl border-2 border-dashed border-slate-700 text-center">
                    <svg class="w-20 h-20 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-slate-300 mb-3">Data Visualization</h3>
                    <p class="text-slate-500 mb-6 max-w-2xl mx-auto">
                        Interactive charts and graphs will appear here after implementing the Data Fusion Engine in Phase 6. 
                        Visualize trends, patterns, and insights from your combined API data.
                    </p>
                    <div class="flex flex-wrap justify-center gap-3 mb-4">
                        <span class="text-sm bg-slate-800 text-slate-400 px-4 py-2 rounded-full flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                            <span>Line Charts</span>
                        </span>
                        <span class="text-sm bg-slate-800 text-slate-400 px-4 py-2 rounded-full flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Bar Graphs</span>
                        </span>
                        <span class="text-sm bg-slate-800 text-slate-400 px-4 py-2 rounded-full flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span>Pie Charts</span>
                        </span>
                        <span class="text-sm bg-slate-800 text-slate-400 px-4 py-2 rounded-full flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            <span>Heatmaps</span>
                        </span>
                    </div>
                    <span class="text-xs bg-indigo-500/20 text-indigo-300 px-3 py-1 rounded-full">Coming in Phase 6</span>
                </div>

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
    function fetchData(apiId, button) {
        const spinner = button.querySelector('.spinner');
        const buttonText = button.querySelector('.button-text');
        
        // Show loading state
        button.disabled = true;
        spinner.classList.remove('hidden');
        spinner.classList.add('animate-spin');
        buttonText.textContent = 'Fetching...';
        
        // Simulate API call (2 seconds)
        setTimeout(() => {
            // Show success state
            spinner.classList.add('hidden');
            spinner.classList.remove('animate-spin');
            buttonText.textContent = 'Fetched!';
            
            // Reset button after 1 second
            setTimeout(() => {
                buttonText.textContent = 'Fetch Data';
                button.disabled = false;
            }, 1000);
        }, 2000);
    }
</script>
@endsection
