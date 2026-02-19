@extends('layouts.layout')

@section('title', 'Data Fusion & Intelligence')

@section('content')
<div class="gradient-bg min-h-screen">
    <div class="flex">
        @include('layouts.partials.sidebar')
        
        <main class="flex-1 ml-64 bg-slate-50/50 min-h-screen">
            <!-- Header -->
            <nav class="glass border-b border-slate-200 sticky top-0 z-30">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Data Fusion</h1>
                        <p class="text-sm font-medium text-slate-500">Unified intelligence layer combining all data sources</p>
                    </div>
                    <form action="{{ route('fusion.generate') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Generate New Snapshot</span>
                        </button>
                    </form>
                </div>
            </nav>

            <div class="p-8 space-y-8">
                @if($fusedData)
                    <!-- Fusion Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-blue-50 rounded-xl">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs bg-blue-100 text-blue-700 font-bold px-2 py-1 rounded">Snapshot</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Sources Fused</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ $fusedData->source_count ?? 0 }}</p>
                        </div>

                        <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-emerald-50 rounded-xl">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs bg-emerald-100 text-emerald-700 font-bold px-2 py-1 rounded">Data</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Data Records</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ $fusedData->record_count ?? 0 }}</p>
                        </div>

                        <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-amber-50 rounded-xl">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                    </svg>
                                </div>
                                <span class="text-xs bg-amber-100 text-amber-700 font-bold px-2 py-1 rounded">Storage</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Data Size</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ number_format($fusedData->size_bytes / 1024 / 1024, 2) }} MB</p>
                        </div>

                        <div class="glass p-6 rounded-2xl border border-slate-200 bg-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-purple-50 rounded-xl">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs bg-purple-100 text-purple-700 font-bold px-2 py-1 rounded">Time</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Fused At</p>
                            <p class="text-2xl font-extrabold text-slate-900">{{ $fusedData->fused_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Data Sources Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        @if($fusedData->weather)
                            <div class="glass p-8 rounded-2xl border border-blue-200 bg-gradient-to-br from-blue-50 to-white shadow-lg hover:shadow-xl transition-all">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-slate-900">🌤️ Weather Data</h3>
                                    <div class="p-3 bg-blue-100 rounded-xl">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                        <span class="text-sm font-medium text-slate-600">Temperature</span>
                                        <span class="text-2xl font-bold text-blue-600">{{ $fusedData->weather['current']['temperature'] ?? 'N/A' }}°C</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                        <span class="text-sm font-medium text-slate-600">Condition</span>
                                        <span class="text-sm font-bold text-slate-900">{{ $fusedData->weather['weather']['description'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                        <span class="text-sm font-medium text-slate-600">Humidity</span>
                                        <span class="text-lg font-bold text-blue-600">{{ $fusedData->weather['current']['humidity'] ?? 'N/A' }}%</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($fusedData->crypto)
                            <div class="glass p-8 rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white shadow-lg hover:shadow-xl transition-all">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-slate-900">💰 Crypto Markets</h3>
                                    <div class="p-3 bg-emerald-100 rounded-xl">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    @php $btc = collect($fusedData->crypto['data'])->where('id', 'bitcoin')->first(); @endphp
                                    @if($btc)
                                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                            <span class="text-sm font-medium text-slate-600">Bitcoin</span>
                                            <span class="text-lg font-bold text-emerald-600">${{ number_format($btc['current_price'] ?? 0, 0) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                            <span class="text-sm font-medium text-slate-600">24h Change</span>
                                            <span class="text-lg font-bold {{ ($btc['change_24h'] ?? 0) >= 0 ? 'text-emerald-600' : 'text-red-600' }}">{{ ($btc['change_24h'] ?? 0) >= 0 ? '+' : '' }}{{ number_format($btc['change_24h'] ?? 0, 2) }}%</span>
                                        </div>
                                    @endif
                                    @php $eth = collect($fusedData->crypto['data'])->where('id', 'ethereum')->first(); @endphp
                                    @if($eth)
                                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                            <span class="text-sm font-medium text-slate-600">Ethereum</span>
                                            <span class="text-lg font-bold text-emerald-600">${{ number_format($eth['current_price'] ?? 0, 0) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($fusedData->news)
                            <div class="glass p-8 rounded-2xl border border-orange-200 bg-gradient-to-br from-orange-50 to-white shadow-lg hover:shadow-xl transition-all">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-slate-900">📰 Latest News</h3>
                                    <div class="p-3 bg-orange-100 rounded-xl">
                                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    @foreach(array_slice($fusedData->news['articles'] ?? [], 0, 3) as $article)
                                        <div class="p-3 bg-white rounded-lg hover:bg-slate-50 transition-colors">
                                            <p class="text-sm font-bold text-slate-900 line-clamp-2">{{ $article['title'] ?? 'No title' }}</p>
                                            <p class="text-xs font-medium text-slate-500 mt-1">{{ $article['source']['name'] ?? 'Unknown' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Raw JSON Data -->
                    <div class="glass p-8 rounded-2xl border border-slate-200 bg-white">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">Raw Fused Data</h3>
                        <div class="bg-slate-900 text-slate-900 p-6 rounded-xl font-mono text-xs overflow-x-auto max-h-96 overflow-y-auto">
                            <pre>{{ json_encode($fusedData->fused_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                        </div>
                    </div>

                    <!-- Export Options -->
                    <div class="glass p-8 rounded-2xl border border-slate-200 bg-white">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">Export Data</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('fusion.export', ['format' => 'json']) }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all hover:scale-105">
                                📄 Export as JSON
                            </a>
                            <a href="{{ route('fusion.export', ['format' => 'csv']) }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold transition-all hover:scale-105">
                                📊 Export as CSV
                            </a>
                            <a href="{{ route('fusion.export', ['format' => 'pdf']) }}" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold transition-all hover:scale-105">
                                📋 Export as PDF
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="glass p-20 rounded-3xl border-2 border-dashed border-slate-200 text-center bg-white/50">
                        <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner ring-8 ring-indigo-50/50 animate-bounce">
                            <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-3 tracking-tight">No Fusion Data</h3>
                        <p class="text-slate-500 max-w-sm mx-auto mb-8 font-medium">Generate your first data fusion snapshot to create a unified intelligence layer.</p>
                        <form action="{{ route('fusion.generate') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/30 transition-all hover:scale-105 active:scale-95 group">
                                <span>Generate First Snapshot</span>
                                <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
