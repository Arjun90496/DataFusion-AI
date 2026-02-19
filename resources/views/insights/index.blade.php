@extends('layouts.layout')

@section('title', 'AI Insights History')

@section('content')
<div class="min-h-screen bg-slate-50/50">
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">AI Insights History</h1>
                <p class="text-slate-500 font-medium leading-relaxed">Intelligence repository: Comprehensive analysis from across your fused data snapshots.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold shadow-sm hover:bg-slate-50 hover:border-slate-300 transition-all group">
                <svg class="w-5 h-5 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Dashboard Overview</span>
            </a>
        </div>

        @if($insights->isEmpty())
            <div class="bg-white p-16 rounded-[2.5rem] border border-slate-200 shadow-sm text-center">
                <div class="w-24 h-24 bg-indigo-50 rounded-[2rem] flex items-center justify-center mx-auto mb-8 shadow-inner ring-8 ring-indigo-50/50">
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">Intelligence Vault Empty</h2>
                <p class="text-slate-500 mb-10 max-w-md mx-auto font-medium leading-relaxed text-lg">Your repository of wisdom is currently awaiting its first entry. Synchronize your data to begin the analysis process.</p>
                <form action="{{ route('fusion.generate') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95 group">
                        <span>Initiate Fusion Scan</span>
                        <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>
            </div>
        @else
            <div class="grid grid-cols-1 gap-8">
                @foreach($insights as $insight)
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 hover:border-indigo-100 transition-all duration-500 group relative overflow-hidden">
                        <!-- Decorative Header Gradient -->
                        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>
                        
                        <div class="flex flex-col xl:flex-row xl:items-start justify-between gap-8 relative z-10">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-4 mb-6">
                                    @php
                                        $sentimentColors = ['emerald' => ['bg' => '#f0fdf4', 'text' => '#059669', 'border' => '#dcfce7'], 'red' => ['bg' => '#fef2f2', 'text' => '#dc2626', 'border' => '#fecaca'], 'slate' => ['bg' => '#f8fafc', 'text' => '#475569', 'border' => '#e2e8f0']];
                                        $colors = $sentimentColors[$insight->sentimentColor] ?? $sentimentColors['slate'];
                                    @endphp
                                    <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border shadow-sm" style="background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; border-color: {{ $colors['border'] }};">
                                        {{ $insight->sentiment }}
                                    </span>
                                    <div class="flex items-center space-x-2 text-slate-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-tighter">{{ $insight->created_at->format('M d, Y • h:i A') }}</span>
                                    </div>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight group-hover:text-indigo-600 transition-colors">Strategic Intelligence Report</h3>
                                <p class="text-slate-600 font-medium leading-relaxed mb-8 text-lg">{{ $insight->summary }}</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                                        <h4 class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Market Patterns</h4>
                                        <ul class="space-y-3">
                                            @foreach(collect($insight->trends)->take(3) as $trend)
                                                <li class="flex items-start space-x-3 text-sm font-bold text-slate-700 leading-tight">
                                                    <div class="mt-0.5 w-4 h-4 bg-indigo-100 rounded flex items-center justify-center text-indigo-600 flex-shrink-0">
                                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </div>
                                                    <span>{{ $trend }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                                        <h4 class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Operational Strategy</h4>
                                        <ul class="space-y-3">
                                            @foreach(collect($insight->recommendations)->take(3) as $rec)
                                                <li class="flex items-start space-x-3 text-sm font-bold text-slate-700 leading-tight">
                                                    <div class="mt-0.5 w-4 h-4 bg-emerald-100 rounded flex items-center justify-center text-emerald-600 flex-shrink-0">
                                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                    <span>{{ $rec }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="xl:w-64 flex flex-col items-center justify-center p-8 bg-slate-50 rounded-3xl border border-slate-200 shadow-inner group/meta">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100 mb-6 group-hover/meta:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-1">Compute Model</p>
                                <p class="font-bold text-slate-900 text-sm mb-6">{{ $insight->model_used }}</p>
                                <div class="w-full h-px bg-slate-200 mb-6"></div>
                                <div class="text-center">
                                    <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($insight->tokens_used) }}</p>
                                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mt-1">Intelligence Tokens</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $insights->links() }}
            </div>
        @endif
    </div>
</div>
@extends('layouts.layout')

@section('title', 'AI Insights')

@section('content')
<div class="gradient-bg min-h-screen">
    <div class="flex">
        @include('layouts.partials.sidebar')
        
        <main class="flex-1 ml-64 bg-slate-50/50 min-h-screen">
            <!-- Header -->
            <nav class="glass border-b border-slate-200 sticky top-0 z-30">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">AI Insights & Analysis</h1>
                        <p class="text-sm font-medium text-slate-500">AI-powered intelligence from your unified data</p>
                    </div>
                    <button onclick="generateInsights()" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-bold shadow-lg shadow-purple-500/20 transition-all hover:scale-105 active:scale-95 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <span>Generate Insights</span>
                    </button>
                </div>
            </nav>

            <div class="p-8 space-y-8">
                <!-- Insights Grid -->
                @if($insights && count($insights) > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        @foreach($insights as $insight)
                            <div class="glass p-8 rounded-2xl border @if($insight->sentiment == 'positive') border-emerald-200 bg-gradient-to-br from-emerald-50 to-white @elseif($insight->sentiment == 'negative') border-red-200 bg-gradient-to-br from-red-50 to-white @else border-blue-200 bg-gradient-to-br from-blue-50 to-white @endif shadow-lg hover:shadow-xl transition-all">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-lg font-bold text-slate-900 flex-1">{{ $insight->title }}</h3>
                                    <div class="p-2 rounded-lg @if($insight->sentiment == 'positive') bg-emerald-100 @elseif($insight->sentiment == 'negative') bg-red-100 @else bg-blue-100 @endif">
                                        @if($insight->sentiment == 'positive')
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @elseif($insight->sentiment == 'negative')
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-slate-600 text-sm mb-4">{{ $insight->summary }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ $insight->created_at->diffForHumans() }}</span>
                                    <span class="text-xs font-bold @if($insight->sentiment == 'positive') text-emerald-600 @elseif($insight->sentiment == 'negative') text-red-600 @else text-blue-600 @endif uppercase tracking-widest">{{ ucfirst($insight->sentiment) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass p-20 rounded-3xl border-2 border-dashed border-slate-200 text-center bg-white/50">
                        <div class="w-24 h-24 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner ring-8 ring-purple-50/50 animate-bounce">
                            <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-3 tracking-tight">No Insights Yet</h3>
                        <p class="text-slate-500 max-w-sm mx-auto mb-8 font-medium">Generate AI insights from your fused data to get intelligent recommendations.</p>
                        <button onclick="generateInsights()" class="px-10 py-4 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl font-bold shadow-xl shadow-purple-500/30 transition-all hover:scale-105 active:scale-95 group">
                            <span>Generate First Insight</span>
                            <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

<script>
    function generateInsights() {
        fetch('{{ route("insights.generate") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        }).then(r => r.json()).then(data => {
            if(data.success) window.location.reload();
            else alert(data.message);
        }).catch(e => alert('Error: ' + e.message));
    }
</script>
@endsection
