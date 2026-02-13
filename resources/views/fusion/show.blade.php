@extends('layouts.layout')

@section('title', 'Data Fusion')

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

            <a href="{{ route('fusion.show') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-indigo-300 border border-indigo-500/30 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                </svg>
                <span class="font-medium">Data Fusion</span>
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
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-100 mb-2">Data Fusion Snapshot</h1>
                <p class="text-slate-400">Unified view of all your data sources</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-slate-400">Last Updated</p>
                <p class="text-lg font-semibold text-slate-200">{{ $fusedData->fused_at->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Fusion Metadata -->
        <div class="glass p-6 rounded-2xl border border-slate-700 mb-6">
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-slate-400 mb-1">Sources</p>
                    <p class="text-2xl font-bold text-slate-100">{{ $fusedData->sources_count }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400 mb-1">Location</p>
                    <p class="text-2xl font-bold text-slate-100">{{ $fusedData->primary_location ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-400 mb-1">Status</p>
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-lg font-semibold text-emerald-400">Active</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Environment (Weather) -->
        @if($fusedData->weather)
        <div class="glass p-6 rounded-2xl border border-slate-700 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-100 flex items-center space-x-2">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                    <span>Environment</span>
                </h2>
                <span class="text-xs bg-amber-500/20 text-amber-300 px-3 py-1 rounded-full">{{ $fusedData->weather['source'] }}</span>
            </div>
            
            @php $weather = $fusedData->weather['data']; @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <p class="text-sm text-slate-400">Temperature</p>
                    <p class="text-2xl font-bold text-slate-100">{{ $weather['current']['temperature'] ?? 'N/A' }}°C</p>
                </div>
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <p class="text-sm text-slate-400">Condition</p>
                    <p class="text-lg font-semibold text-slate-100">{{ $weather['weather']['description'] ?? 'N/A' }}</p>
                </div>
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <p class="text-sm text-slate-400">Humidity</p>
                    <p class="text-2xl font-bold text-slate-100">{{ $weather['current']['humidity'] ?? 'N/A' }}%</p>
                </div>
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <p class="text-sm text-slate-400">Wind Speed</p>
                    <p class="text-2xl font-bold text-slate-100">{{ $weather['wind']['speed'] ?? 'N/A' }} m/s</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Briefing (News) -->
        @if($fusedData->news)
        <div class="glass p-6 rounded-2xl border border-slate-700 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-100 flex items-center space-x-2">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span>News Briefing</span>
                </h2>
                <span class="text-xs bg-blue-500/20 text-blue-300 px-3 py-1 rounded-full">{{ $fusedData->news['source'] }}</span>
            </div>
            
            @php $news = $fusedData->news['data']; @endphp
            <div class="space-y-3">
                @foreach(array_slice($news['articles'] ?? [], 0, 5) as $article)
                <div class="bg-slate-800/50 p-4 rounded-lg hover:bg-slate-800/70 transition-colors">
                    <h3 class="font-semibold text-slate-100 mb-1">{{ $article['title'] }}</h3>
                    <p class="text-sm text-slate-400 mb-2">{{ $article['description'] }}</p>
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span>{{ $article['source']['name'] ?? 'Unknown' }}</span>
                        <span>{{ $article['author'] ?? 'Unknown Author' }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Markets (Crypto) -->
        @if($fusedData->crypto)
        <div class="glass p-6 rounded-2xl border border-slate-700 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-100 flex items-center space-x-2">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Markets</span>
                </h2>
                <span class="text-xs bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full">{{ $fusedData->crypto['source'] }}</span>
            </div>
            
            @php $crypto = $fusedData->crypto['data']; @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($crypto['data'] ?? [] as $coin)
                <div class="bg-slate-800/50 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-slate-100 uppercase">{{ $coin['id'] }}</h3>
                        @if(isset($coin['change_24h']))
                        <span class="text-sm {{ $coin['change_24h'] >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                            {{ $coin['change_24h'] >= 0 ? '+' : '' }}{{ number_format($coin['change_24h'], 2) }}%
                        </span>
                        @endif
                    </div>
                    <p class="text-2xl font-bold text-slate-100">${{ number_format($coin['current_price'] ?? 0, 2) }}</p>
                    @if(isset($coin['market_cap']))
                    <p class="text-xs text-slate-500 mt-1">MCap: ${{ number_format($coin['market_cap'], 0) }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- AI Insights -->
        @if($aiInsight)
        <div class="glass p-6 rounded-2xl border border-slate-700 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-100 flex items-center space-x-2">
                    <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    <span>AI Insights</span>
                </h2>
                <div class="flex items-center space-x-3">
                    <span class="text-xs bg-{{ $aiInsight->sentimentColor }}-500/20 text-{{ $aiInsight->sentimentColor }}-300 px-3 py-1 rounded-full">
                        {{ ucfirst($aiInsight->sentiment) }}
                    </span>
                    <span class="text-xs text-slate-500">{{ $aiInsight->tokens_used }} tokens</span>
                </div>
            </div>
            
            <!-- Summary -->
            <div class="bg-slate-800/50 p-4 rounded-lg mb-4">
                <h3 class="text-sm font-semibold text-slate-300 mb-2">Summary</h3>
                <p class="text-slate-100">{{ $aiInsight->summary }}</p>
            </div>
            
            <!-- Trends -->
            @if($aiInsight->trends && count($aiInsight->trends) > 0)
            <div class="bg-slate-800/50 p-4 rounded-lg mb-4">
                <h3 class="text-sm font-semibold text-slate-300 mb-2">Detected Trends</h3>
                <ul class="space-y-2">
                    @foreach($aiInsight->trends as $trend)
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-indigo-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-slate-200">{{ $trend }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Recommendations -->
            @if($aiInsight->recommendations && count($aiInsight->recommendations) > 0)
            <div class="bg-slate-800/50 p-4 rounded-lg">
                <h3 class="text-sm font-semibold text-slate-300 mb-2">Recommendations</h3>
                <ul class="space-y-2">
                    @foreach($aiInsight->recommendations as $recommendation)
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-slate-200">{{ $recommendation }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Generate New Fusion -->
            <div class="glass p-6 rounded-2xl border border-slate-700">
                <form action="{{ route('fusion.generate') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105">
                        Generate New Fusion Snapshot
                    </button>
                </form>
            </div>
            
            <!-- Generate AI Insights -->
            <div class="glass p-6 rounded-2xl border border-slate-700">
                <form action="{{ route('insights.generate') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-700 hover:to-rose-700 text-white rounded-lg font-semibold shadow-lg shadow-pink-500/40 transition-all duration-300 hover:scale-105" {{ $aiInsight ? 'disabled' : '' }}>
                        {{ $aiInsight ? 'Insights Generated' : 'Generate AI Insights' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
