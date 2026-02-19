<!-- Sidebar Navigation -->
<aside class="fixed left-0 top-0 h-screen w-64 glass border-r border-slate-200 z-40 overflow-y-auto">
    <div class="flex flex-col h-full text-slate-700">
        <!-- Logo -->
        <div class="p-6 border-b border-slate-100">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20 transition-transform group-hover:rotate-12">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="text-xl font-black text-slate-900 tracking-tight">DataFusion <span class="text-indigo-600">AI</span></span>
            </a>
        </div>

        <!-- User Profile Area -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-700 rounded-2xl flex items-center justify-center font-black shadow-inner border border-indigo-200">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest truncate">Alpha Member</p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 p-4 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                <div class="flex items-center">
                    <div class="p-2 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-slate-50 group-hover:bg-indigo-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">Dashboard</span>
                </div>
            </a>

            <!-- API Keys -->
            <a href="{{ route('api-keys.index') }}" 
               class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('api-keys.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                <div class="flex items-center">
                    <div class="p-2 rounded-xl transition-colors {{ request()->routeIs('api-keys.*') ? 'bg-white/20' : 'bg-slate-50 group-hover:bg-indigo-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">API Connectivity</span>
                </div>
            </a>

            <div class="pt-4 pb-2 px-4">
                <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Intelligence</span>
            </div>

            <!-- Data Fusion -->
            <a href="{{ route('fusion.show') }}" 
               class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('fusion.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                <div class="flex items-center">
                    <div class="p-2 rounded-xl transition-colors {{ request()->routeIs('fusion.*') ? 'bg-white/20' : 'bg-slate-50 group-hover:bg-indigo-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">Data Fusion</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[8px] font-black uppercase tracking-widest {{ request()->routeIs('fusion.*') ? 'bg-white/20 text-white' : 'bg-indigo-100 text-indigo-600' }}">Active</span>
            </a>

            <!-- AI Insights -->
            <a href="{{ route('insights.index') }}" 
               class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('insights.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                <div class="flex items-center">
                    <div class="p-2 rounded-xl transition-colors {{ request()->routeIs('insights.*') ? 'bg-white/20' : 'bg-slate-50 group-hover:bg-indigo-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">AI Insights</span>
                </div>
                <span class="px-2 py-0.5 rounded-md text-[8px] font-black uppercase tracking-widest {{ request()->routeIs('insights.*') ? 'bg-white/20 text-white' : 'bg-indigo-100 text-indigo-600' }}">Active</span>
            </a>

            <!-- Monitoring -->
            <a href="{{ route('monitoring.index') }}" 
               class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('monitoring.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                <div class="flex items-center">
                    <div class="p-2 rounded-xl transition-colors {{ request()->routeIs('monitoring.*') ? 'bg-white/20' : 'bg-slate-50 group-hover:bg-indigo-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">Monitoring</span>
                </div>
            </a>

            <!-- Settings -->
            <a href="{{ route('settings.index') }}" 
               class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('settings.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                <div class="flex items-center">
                    <div class="p-2 rounded-xl transition-colors {{ request()->routeIs('settings.*') ? 'bg-white/20' : 'bg-slate-50 group-hover:bg-indigo-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">Settings</span>
                </div>
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-slate-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center group px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition-all duration-300">
                    <div class="p-2 bg-red-100 rounded-xl group-hover:bg-red-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-bold text-sm tracking-tight">Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</aside>
