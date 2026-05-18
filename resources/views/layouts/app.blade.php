<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenfield Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-800 text-slate-100 font-sans antialiased">

    <nav class="bg-indigo-700 shadow-lg">
        <div class="w-full px-6 lg:px-12 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-2xl font-bold tracking-wide text-white">Greenfield Portal</span>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2 bg-indigo-800 px-3 py-1.5 rounded-full border border-indigo-500">
                    <svg class="w-6 h-6 text-indigo-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium text-white">{{ Auth::user()->name }}</span>
                </div>

                <div class="h-6 w-px bg-indigo-500"></div>
                <a href="/logout" class="text-indigo-200 hover:text-white font-medium text-sm transition-colors">Log Out</a>
            </div>
        </div>

        <div class="w-full px-6 lg:px-12 bg-indigo-800 border-t border-indigo-600">
            <div class="flex space-x-8 text-sm font-medium">
                @if(Auth::user()->role === 'admin')
                    <a href="/admin" class="hover:text-white py-3 {{ request()->is('admin') ? 'text-white border-b-2 border-white' : 'text-indigo-300' }}">Course Catalog</a>
                    <a href="/admin/students" class="hover:text-white py-3 {{ request()->is('admin/students') ? 'text-white border-b-2 border-white' : 'text-indigo-300' }}">Manage Students</a>
                @else
                    <a href="/dashboard" class="hover:text-white py-3 {{ request()->is('dashboard') ? 'text-white border-b-2 border-white' : 'text-indigo-300' }}">Course Dashboard</a>
                    <a href="/academics" class="hover:text-white py-3 {{ request()->is('academics') ? 'text-white border-b-2 border-white' : 'text-indigo-300' }}">Academics & Results</a>
                    <a href="/financials" class="hover:text-white py-3 {{ request()->is('financials') ? 'text-white border-b-2 border-white' : 'text-indigo-300' }}">Financials</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="w-full px-6 lg:px-12 py-8">
        @if(session('success'))
            <div class="bg-emerald-900 border border-emerald-500 text-emerald-300 px-4 py-3 rounded mb-6 shadow-md">&#10003; {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-900 border border-red-500 text-red-300 px-4 py-3 rounded mb-6 shadow-md">⚠ {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
