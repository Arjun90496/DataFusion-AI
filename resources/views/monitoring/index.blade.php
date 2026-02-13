@extends('layouts.layout')

@section('title', 'Activity Monitoring')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-screen w-64 glass border-r border-slate-700 p-6 flex flex-col">
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-8">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <span class="text-xl font-bold text-slate-100">DataFusion AI</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('api-keys.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
                <span class="font-medium">API Keys</span>
            </a>

            <a href="{{ route('fusion.show') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                </svg>
                <span class="font-medium">Data Fusion</span>
            </a>

            <a href="{{ route('monitoring.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-indigo-300 border border-indigo-500/30 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="font-medium">Monitoring</span>
            </a>
        </nav>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-400 hover:text-red-400 hover:bg-slate-800/50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-100 mb-2">Activity Monitoring</h1>
            <p class="text-slate-400">Track API usage, performance, and errors</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-400">Total Requests</p>
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-slate-100">{{ $stats['total_requests'] }}</p>
                <p class="text-xs text-slate-500 mt-1">Today</p>
            </div>

            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-400">Successful</p>
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-emerald-400">{{ $stats['successful_requests'] }}</p>
                <p class="text-xs text-slate-500 mt-1">2xx responses</p>
            </div>

            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-400">Failed</p>
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-red-400">{{ $stats['failed_requests'] }}</p>
                <p class="text-xs text-slate-500 mt-1">4xx/5xx errors</p>
            </div>

            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-400">Avg Response</p>
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-slate-100">{{ $stats['avg_response_time'] ?? 0 }}ms</p>
                <p class="text-xs text-slate-500 mt-1">Response time</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="glass p-6 rounded-2xl border border-slate-700 mb-8">
            <h2 class="text-xl font-bold text-slate-100 mb-4">Recent Activity</h2>
            <div class="space-y-2">
                @forelse($recentLogs as $log)
                <div class="bg-slate-800/50 p-4 rounded-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $log->isSuccessful() ? 'bg-emerald-500/20 text-emerald-300' : 'bg-red-500/20 text-red-300' }}">
                            {{ $log->status_code }}
                        </span>
                        <span class="text-sm font-mono text-slate-300">{{ $log->method }}</span>
                        <span class="text-sm text-slate-400">{{ $log->endpoint }}</span>
                    </div>
                    <div class="flex items-center space-x-4 text-xs text-slate-500">
                        <span>{{ $log->response_time_ms }}ms</span>
                        <span>{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <p class="text-slate-400 text-center py-8">No activity logged yet</p>
                @endforelse
            </div>
        </div>

        <!-- Error Logs -->
        @if($errorLogs->count() > 0)
        <div class="glass p-6 rounded-2xl border border-red-700/50 mb-8">
            <h2 class="text-xl font-bold text-red-400 mb-4">Recent Errors</h2>
            <div class="space-y-2">
                @foreach($errorLogs as $log)
                <div class="bg-red-900/20 p-4 rounded-lg border border-red-700/30">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-3">
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-red-500/20 text-red-300">
                                {{ $log->status_code }}
                            </span>
                            <span class="text-sm font-mono text-slate-300">{{ $log->method }} {{ $log->endpoint }}</span>
                        </div>
                        <span class="text-xs text-slate-500">{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    @if($log->error_message)
                    <p class="text-sm text-red-300 mt-2">{{ $log->error_message }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Endpoint Statistics -->
        <div class="glass p-6 rounded-2xl border border-slate-700">
            <h2 class="text-xl font-bold text-slate-100 mb-4">Top Endpoints</h2>
            <div class="space-y-3">
                @forelse($endpointStats as $stat)
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-mono text-slate-300">{{ $stat->endpoint }}</span>
                        <span class="text-sm text-slate-400">{{ $stat->count }} requests</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-1 bg-slate-700 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ min(100, ($stat->count / $stats['total_requests']) * 100) }}%"></div>
                        </div>
                        <span class="text-xs text-slate-500">{{ round($stat->avg_time) }}ms avg</span>
                    </div>
                </div>
                @empty
                <p class="text-slate-400 text-center py-8">No endpoint statistics available</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
