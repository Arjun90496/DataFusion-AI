<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'DataFusion AI - Intelligent Data Integration' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect fill='%234f46e5' width='100' height='100'/><text x='50' y='65' font-size='80' font-weight='bold' text-anchor='middle' fill='white' font-family='Arial'>D</text></svg>">
    
    <!-- Vite CSS -->
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 text-slate-700 min-h-screen antialiased">
    
    <!-- Flash Messages - Light Theme -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 animate-slide-up">
            <div class="glass bg-white border-emerald-200 text-emerald-900 px-6 py-4 rounded-xl shadow-xl flex items-center space-x-3 max-w-md">
                <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Success</p>
                    <p class="text-sm text-slate-600">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50 animate-slide-up">
            <div class="glass bg-white border-red-200 text-red-900 px-6 py-4 rounded-xl shadow-xl flex items-center space-x-3 max-w-md">
                <div class="p-2 bg-red-100 rounded-lg text-red-600">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Error</p>
                    <p class="text-sm text-slate-600">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="fixed top-4 right-4 z-50 animate-slide-up">
            <div class="glass bg-white border-blue-200 text-blue-900 px-6 py-4 rounded-xl shadow-xl flex items-center space-x-3 max-w-md">
                <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Info</p>
                    <p class="text-sm text-slate-600">{{ session('info') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- Auto-hide flash messages after 5 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.fixed.top-4');
            
            flashMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-20px)';
                    
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
    
    <!-- Vite JS -->
    @vite('resources/js/app.js')
</body>
</html>
