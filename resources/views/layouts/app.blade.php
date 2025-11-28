<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BMAD Generator')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .code-block {
            background-color: #1e1e1e;
            border-radius: 0.5rem;
            padding: 1rem;
            overflow-x: auto;
        }
        .code-block code {
            color: #d4d4d4;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            white-space: pre;
        }
        .file-tree {
            font-family: monospace;
        }
        .file-item {
            padding: 0.25rem 0.5rem;
            cursor: pointer;
            border-radius: 0.25rem;
        }
        .file-item:hover {
            background-color: #f3f4f6;
        }
        .file-item.active {
            background-color: #dbeafe;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('bmad.index') }}" class="text-2xl font-bold flex items-center">
                    <i class="fas fa-layer-group mr-2"></i>
                    BMAD Generator
                </a>
                <div class="text-sm">
                    <span class="bg-white/20 px-3 py-1 rounded-full">
                        <i class="fas fa-robot mr-1"></i>
                        Powered by Z.AI (glm-4.6)
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-12 py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} BMAD Generator - Break My App Down Technique</p>
            <p class="text-sm text-gray-400 mt-2">AI-Powered Project Structure Generator</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
