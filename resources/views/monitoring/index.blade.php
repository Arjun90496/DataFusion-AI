@extends('layouts.layout')

@section('title', 'Activity Monitoring')

@section('content')
<div class="min-h-screen bg-slate-50/50">
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Activity Monitoring</h1>
            <p class="text-slate-600">Track API usage, performance, and errors</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-600">Total Requests</p>
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $stats['total_requests'] }}</p>
                <p class="text-xs text-slate-500 mt-1">Today</p>
            </div>

            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-600">Successful</p>
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-emerald-400">{{ $stats['successful_requests'] }}</p>
                <p class="text-xs text-slate-500 mt-1">2xx responses</p>
            </div>

            <div class="glass p-6 rounded-2xl border border-slate-700">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-600">Failed</p>
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-red-400">{{ $stats['failed_requests'] }}</p>
                <p class="text-xs text-slate-500 mt-1">4xx/5xx errors</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-slate-500 font-medium">Avg Response</p>
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $stats['avg_response_time'] ?? 0 }}<span class="text-base text-slate-600 font-bold ml-1">ms</span></p>
                <p class="text-xs text-slate-500 mt-1">Response time</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 mb-8 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 mb-4 tracking-tight">Recent Activity</h2>
            <div class="space-y-2">
                @forelse($recentLogs as $log)
                <div class="bg-slate-50 p-4 rounded-xl flex items-center justify-between border border-slate-100 hover:border-indigo-100 transition-colors">
                    <div class="flex items-center space-x-4">
                        <span class="px-2 py-1 text-[10px] font-black rounded-lg {{ $log->isSuccessful() ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-red-50 text-red-700 border border-red-100' }}">
                            {{ $log->status_code }}
                        </span>
                        <span class="text-sm font-bold font-mono text-slate-700">{{ $log->method }}</span>
                        <span class="text-sm font-medium text-slate-500">{{ $log->endpoint }}</span>
                    </div>
                    <div class="flex items-center space-x-4 text-xs text-slate-500">
                        <span>{{ $log->response_time_ms }}ms</span>
                        <span>{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <p class="text-slate-600 text-center py-8">No activity logged yet</p>
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
                            <span class="text-sm font-mono text-slate-700">{{ $log->method }} {{ $log->endpoint }}</span>
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
            <h2 class="text-xl font-bold text-slate-900 mb-4">Top Endpoints</h2>
            <div class="space-y-3">
                @forelse($endpointStats as $stat)
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-mono text-slate-700">{{ $stat->endpoint }}</span>
                        <span class="text-sm text-slate-600">{{ $stat->count }} requests</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-1 bg-slate-700 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ min(100, ($stat->count / $stats['total_requests']) * 100) }}%"></div>
                        </div>
                        <span class="text-xs text-slate-500">{{ round($stat->avg_time) }}ms avg</span>
                    </div>
                </div>
                @empty
                <p class="text-slate-600 text-center py-8">No endpoint statistics available</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@extends('layouts.layout')

@section('title', 'System Monitoring')

@section('content')
<div class="gradient-bg min-h-screen">
    <div class="flex">
        @include('layouts.partials.sidebar')
        
        <main class="flex-1 ml-64 bg-slate-50/50 min-h-screen">
            <!-- Header -->
            <nav class="glass border-b border-slate-200 sticky top-0 z-30">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">System Monitoring</h1>
                        <p class="text-sm font-medium text-slate-500">Real-time system health and performance metrics</p>
                    </div>
                </div>
            </nav>

            <div class="p-8 space-y-8">
                <!-- System Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-emerald-50 rounded-xl">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                        </div>
                        <p class="text-sm text-slate-500 mb-1">System Status</p>
                        <p class="text-3xl font-extrabold text-slate-900">Healthy</p>
                    </div>

                    <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-blue-50 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xs bg-blue-100 text-blue-700 font-bold px-2 py-1 rounded">Live</span>
                        </div>
                        <p class="text-sm text-slate-500 mb-1">API Calls (1h)</p>
                        <p class="text-3xl font-extrabold text-slate-900">{{ $stats['api_calls'] ?? 0 }}</p>
                    </div>

                    <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-amber-50 rounded-xl">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs bg-amber-100 text-amber-700 font-bold px-2 py-1 rounded">Warning</span>
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Error Rate</p>
                        <p class="text-3xl font-extrabold text-slate-900">{{ $stats['error_rate'] ?? '0' }}%</p>
                    </div>

                    <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-purple-50 rounded-xl">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Avg Response Time</p>
                        <p class="text-3xl font-extrabold text-slate-900">{{ $stats['avg_response_time'] ?? '0' }}ms</p>
                    </div>
                </div>

                <!-- Recent API Logs -->
                <div class="glass p-8 rounded-2xl border border-slate-200 bg-white">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Recent API Activity</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="px-6 py-3 text-left font-bold text-slate-600">Endpoint</th>
                                    <th class="px-6 py-3 text-left font-bold text-slate-600">Status</th>
                                    <th class="px-6 py-3 text-left font-bold text-slate-600">Response Time</th>
                                    <th class="px-6 py-3 text-left font-bold text-slate-600">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs ?? [] as $log)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="px-6 py-3 font-mono text-xs text-slate-900">{{ $log['endpoint'] ?? 'N/A' }}</td>
                                        <td class="px-6 py-3">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold @if(($log['status_code'] ?? 500) < 300) bg-emerald-100 text-emerald-700 @elseif(($log['status_code'] ?? 500) < 400) bg-blue-100 text-blue-700 @else bg-red-100 text-red-700 @endif">
                                                {{ $log['status_code'] ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 text-slate-600">{{ $log['response_time'] ?? 'N/A' }}ms</td>
                                        <td class="px-6 py-3 text-slate-500">{{ $log['created_at'] ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">No API logs yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
