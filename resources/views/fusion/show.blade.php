@extends('layouts.layout')

@section('title', 'Data Fusion')

@section('content')
<div class="min-h-screen bg-slate-50/50">
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Main Content -->
    <main class="ml-64 p-8">
        @if(!$fusedData)
            <!-- Empty State -->
            <div class="h-[calc(100vh-4rem)] flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 bg-indigo-50 rounded-[2rem] flex items-center justify-center mb-8 shadow-inner ring-8 ring-indigo-50/50 animate-bounce-slow">
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">No Fusion Data Yet</h1>
                <p class="text-slate-500 max-w-lg mb-10 text-lg font-medium leading-relaxed">
                    Ready to unify your intelligence? Generate a fusion snapshot to combine data from all your connected APIs into a single, cohesive layer.
                </p>
                <form action="{{ route('fusion.generate') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/20 transition-all duration-300 hover:scale-105 active:scale-95 group">
                        <span>Generate Your First Fusion</span>
                        <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>
            </div>
        @else
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Fusion Snapshot</h1>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-widest rounded-full border border-indigo-100 shadow-sm">Real-time Intelligence</span>
                        <p class="text-sm font-medium text-slate-500 italic">Unified intelligence layer from connected sources</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
                    <div class="p-2 bg-slate-50 rounded-lg">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest leading-none mb-1">Last Updated</p>
                        <p class="text-sm font-bold text-slate-900 leading-none">{{ $fusedData->fused_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Fusion Metadata -->
            <div class="glass p-8 rounded-3xl border border-slate-200 mb-8 bg-white/50 relative overflow-hidden group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-0.5">Total Sources</p>
                            <p class="text-2xl font-black text-slate-900">{{ $fusedData->sources_count }} <span class="text-sm font-bold text-slate-600">APIs</span></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shadow-sm border border-amber-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-0.5">Primary Location</p>
                            <p class="text-2xl font-black text-slate-900 truncate max-w-[150px]">{{ $fusedData->primary_location ?? 'Global' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shadow-sm border border-emerald-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-0.5">System Status</p>
                            <div class="flex items-center space-x-2">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                                <span class="text-xl font-black text-emerald-600">Sync Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI Insights (Prioritized) -->
            @if($aiInsight)
            <div class="glass p-8 rounded-3xl border border-slate-200 mb-8 bg-white/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-pink-500/5 rounded-full blur-3xl -mr-24 -mt-24"></div>
                
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-pink-50 rounded-2xl border border-pink-100 text-pink-600 shadow-sm shadow-pink-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Intelligence Highlights</h2>
                            <p class="text-sm font-medium text-slate-500">Cross-source correlation and analysis</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        @php
                            $sentimentColors = ['emerald' => ['bg' => '#f0fdf4', 'text' => '#059669', 'border' => '#dcfce7'], 'red' => ['bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'], 'slate' => ['bg' => '#f8fafc', 'text' => '#475569', 'border' => '#e2e8f0']];
                            $colors = $sentimentColors[$aiInsight->sentimentColor] ?? $sentimentColors['slate'];
                        @endphp
                        <span class="text-[10px] font-bold uppercase tracking-widest rounded-full border shadow-sm px-3 py-1" style="background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; border-color: {{ $colors['border'] }};">
                            Sentiment: {{ ucfirst($aiInsight->sentiment) }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">{{ $aiInsight->tokens_used }} tokens</span>
                    </div>
                </div>
                
                <div class="space-y-6 relative z-10">
                    <!-- Summary -->
                    <div class="bg-indigo-50/30 p-6 rounded-2xl border border-indigo-100 shadow-inner">
                        <h3 class="text-xs font-bold text-indigo-900 uppercase tracking-widest mb-3 opacity-60">Executive Summary</h3>
                        <p class="text-slate-800 font-medium leading-relaxed">{{ $aiInsight->summary }}</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Trends -->
                        @if($aiInsight->trends && count($aiInsight->trends) > 0)
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-xs font-bold text-slate-600 uppercase tracking-widest mb-4">Detected Trends</h3>
                            <ul class="space-y-3">
                                @foreach($aiInsight->trends as $trend)
                                <li class="flex items-start space-x-3 group/trend">
                                    <div class="mt-1 w-5 h-5 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500 flex-shrink-0 group-hover/trend:bg-indigo-600 group-hover/trend:text-white transition-all duration-300">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 leading-tight">{{ $trend }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <!-- Recommendations -->
                        @if($aiInsight->recommendations && count($aiInsight->recommendations) > 0)
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-xs font-bold text-slate-600 uppercase tracking-widest mb-4">Action Plan</h3>
                            <ul class="space-y-3">
                                @foreach($aiInsight->recommendations as $recommendation)
                                <li class="flex items-start space-x-3 group/rec">
                                    <div class="mt-1 w-5 h-5 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500 flex-shrink-0 group-hover/rec:bg-emerald-600 group-hover/rec:text-white transition-all duration-300">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 leading-tight">{{ $recommendation }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Environment (Weather) -->
            @if($fusedData->weather)
            <div class="glass p-8 rounded-3xl border border-slate-200 mb-8 bg-white/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl -mr-24 -mt-24"></div>
                
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-amber-50 rounded-2xl border border-amber-100 text-amber-600 shadow-sm shadow-amber-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Environmental Context</h2>
                            <p class="text-sm font-medium text-slate-500">Live climate and location metrics</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-3 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold uppercase tracking-widest rounded-full border border-amber-100">
                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                        <span>Source: {{ $fusedData->weather['source'] }}</span>
                    </div>
                </div>
                
                @php $weather = $fusedData->weather['data']; @endphp
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 relative z-10">
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm group/item hover:border-amber-200 transition-colors">
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-2">Temperature</p>
                        <p class="text-3xl font-black text-slate-900">{{ $weather['current']['temperature'] ?? 'N/A' }}<span class="text-lg text-slate-600 font-bold ml-1">°C</span></p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm group/item hover:border-amber-200 transition-colors">
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-2">Condition</p>
                        <p class="text-xl font-extrabold text-slate-900 line-clamp-1">{{ ucfirst($weather['weather']['description'] ?? 'N/A') }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm group/item hover:border-amber-200 transition-colors">
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-2">Humidity</p>
                        <p class="text-3xl font-black text-slate-900">{{ $weather['current']['humidity'] ?? 'N/A' }}<span class="text-lg text-slate-600 font-bold ml-1">%</span></p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm group/item hover:border-amber-200 transition-colors">
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-2">Wind Velocity</p>
                        <p class="text-3xl font-black text-slate-900">{{ $weather['wind']['speed'] ?? 'N/A' }}<span class="text-xs text-slate-600 font-bold ml-1 uppercase">m/s</span></p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Briefing (News) -->
            @if($fusedData->news)
            <div class="glass p-8 rounded-3xl border border-slate-200 mb-8 bg-white/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl -mr-24 -mt-24"></div>
                
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-50 rounded-2xl border border-blue-100 text-blue-600 shadow-sm shadow-blue-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Global Briefing</h2>
                            <p class="text-sm font-medium text-slate-500">Synthesized news from around the world</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold uppercase tracking-widest rounded-full border border-blue-100">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                        <span>Source: {{ $fusedData->news['source'] }}</span>
                    </div>
                </div>
                
                @php $news = $fusedData->news['data']; @endphp
                <div class="space-y-4 relative z-10">
                    @foreach(array_slice($news['articles'] ?? [], 0, 5) as $article)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:border-blue-200 hover:shadow-md transition-all duration-300 group/article">
                        <h3 class="font-bold text-slate-900 text-lg mb-2 group-hover/article:text-blue-600 transition-colors">{{ $article['title'] }}</h3>
                        <p class="text-sm text-slate-500 font-medium mb-4 leading-relaxed">{{ Str::limit($article['description'] ?? 'Detailed analysis available for this briefing piece.', 180) }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-600 border border-slate-200 uppercase">{{ substr($article['source']['name'] ?? 'U', 0, 1) }}</div>
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-tighter">{{ $article['source']['name'] ?? 'Global Source' }}</span>
                            </div>
                            <span class="text-[10px] font-bold text-slate-700 uppercase tracking-widest">{{ $article['author'] ? 'By ' . Str::limit($article['author'], 20) : 'Verified Intelligence' }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Markets (Crypto) -->
            @if($fusedData->crypto)
            <div class="glass p-8 rounded-3xl border border-slate-200 mb-8 bg-white/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-emerald-500/5 rounded-full blur-3xl -mr-24 -mt-24"></div>
                
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-emerald-50 rounded-2xl border border-emerald-100 text-emerald-600 shadow-sm shadow-emerald-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Market Analytics</h2>
                            <p class="text-sm font-medium text-slate-500">Real-time asset performance tracking</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-widest rounded-full border border-emerald-100">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span>Source: {{ $fusedData->crypto['source'] }}</span>
                    </div>
                </div>
                
                @php $crypto = $fusedData->crypto['data']; @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                    @foreach($crypto['data'] ?? [] as $coin)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:border-emerald-200 hover:shadow-md transition-all duration-300 flex items-center justify-between group/coin">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center font-black text-slate-600 text-xs border border-slate-100 group-hover/coin:bg-emerald-50 group-hover/coin:text-emerald-500 transition-colors uppercase">{{ $coin['id'] }}</div>
                            <div>
                                <h3 class="font-bold text-slate-900 uppercase tracking-wide">{{ $coin['id'] }}</h3>
                                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">{{ number_format($coin['market_cap'] ?? 0, 0) }} MCAP</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-black text-slate-900 tracking-tight">${{ number_format($coin['current_price'] ?? 0, 2) }}</p>
                            @if(isset($coin['change_24h']))
                            <div class="flex items-center justify-end space-x-1 mt-0.5">
                                <svg class="w-3 h-3 {{ $coin['change_24h'] >= 0 ? 'text-emerald-500' : 'text-red-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="{{ $coin['change_24h'] >= 0 ? 'M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z' : 'M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' }}" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-xs font-bold {{ $coin['change_24h'] >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                    {{ abs(number_format($coin['change_24h'], 2)) }}%
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Generate New Fusion -->
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 border border-indigo-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 leading-tight">Unified Refresh</h3>
                            <p class="text-sm font-medium text-slate-500">Sync all sources and regenerate AI insights</p>
                        </div>
                    </div>
                    <form action="{{ route('fusion.generate') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-6 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                            Regenerate Fusion & AI Analysis
                        </button>
                    </form>
                </div>
                
                <!-- History Link -->
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-pink-50 rounded-2xl flex items-center justify-center text-pink-600 border border-pink-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 leading-tight">Strategic Archive</h3>
                            <p class="text-sm font-medium text-slate-500">Review historical insights and trends</p>
                        </div>
                    </div>
                    <a href="{{ route('insights.index') }}" class="w-full block text-center px-6 py-4 bg-white border border-slate-200 text-slate-900 rounded-2xl font-bold hover:bg-slate-50 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                        View Insight History
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
