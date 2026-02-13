<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'DataFusion AI - Intelligent Data Integration' }}</title>
    
    <!-- Tailwind CSS CDN with JIT -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        // Custom indigo shades for dark theme
                        'indigo': {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                        // Custom slate shades for dark backgrounds
                        'slate': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    animation: {
                        'gradient': 'gradient 8s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'fade-in': 'fadeIn 0.6s ease-out',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(99, 102, 241, 0.3)' },
                            '100%': { boxShadow: '0 0 30px rgba(99, 102, 241, 0.6)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                    },
                }
            }
        }
    </script>
    
    <!-- Custom CSS for Advanced Effects -->
    <style>
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom gradient background animation */
        .gradient-bg {
            background: linear-gradient(-45deg, #020617, #1e1b4b, #312e81, #0f172a);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        /* Glassmorphism effect */
        .glass {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(148, 163, 184, 0.1);
        }
        
        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Enhanced focus states for accessibility */
        *:focus-visible {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }
        
        /* Custom scrollbar for dark theme */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen antialiased">
    
    <!-- Flash Messages - Dark Theme -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 animate-slide-up">
            <div class="glass bg-emerald-500/20 border-emerald-500/50 text-emerald-100 px-6 py-4 rounded-xl shadow-2xl shadow-emerald-500/20 flex items-center space-x-3 max-w-md">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Success!</p>
                    <p class="text-sm text-emerald-200">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50 animate-slide-up">
            <div class="glass bg-red-500/20 border-red-500/50 text-red-100 px-6 py-4 rounded-xl shadow-2xl shadow-red-500/20 flex items-center space-x-3 max-w-md">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Error</p>
                    <p class="text-sm text-red-200">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="fixed top-4 right-4 z-50 animate-slide-up">
            <div class="glass bg-blue-500/20 border-blue-500/50 text-blue-100 px-6 py-4 rounded-xl shadow-2xl shadow-blue-500/20 flex items-center space-x-3 max-w-md">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Info</p>
                    <p class="text-sm text-blue-200">{{ session('info') }}</p>
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
</body>
</html>
