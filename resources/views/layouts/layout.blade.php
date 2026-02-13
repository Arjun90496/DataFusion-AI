<!DOCTYPE html>
<html lang="en" class="light">
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
                        // Custom indigo shades for light theme
                        'indigo': {
                            50: '#f5f7ff',
                            100: '#ebf0ff',
                            200: '#d6e0ff',
                            300: '#adc2ff',
                            400: '#85a3ff',
                            500: '#5c85ff',
                            600: '#4f46e5', // Brand primary
                            700: '#3730a3',
                            800: '#2e2a85',
                            900: '#1e1b4b',
                        },
                        // Custom slate shades for light backgrounds
                        'slate': {
                            50: '#f8fafc', // App background
                            100: '#f1f5f9', // Panel backgrounds
                            200: '#e2e8f0', // Borders
                            300: '#cbd5e1', // Dividers
                            400: '#94a3b8', // Muted text
                            500: '#64748b', // Labels
                            600: '#475569', // Primary text
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a', // Heavy text
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
                            '0%': { boxShadow: '0 0 20px rgba(79, 70, 229, 0.1)' },
                            '100%': { boxShadow: '0 0 30px rgba(79, 70, 229, 0.2)' },
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
        
        /* Custom gradient background animation for light theme */
        .gradient-bg {
            background: linear-gradient(-45deg, #f8fafc, #e0e7ff, #f1f5f9, #ffffff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        /* Light mode glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.5);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        /* Vibrant gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Enhanced focus states */
        *:focus-visible {
            outline: 2px solid #4f46e5;
            outline-offset: 2px;
        }
        
        /* Light theme scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
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
</body>
</html>
