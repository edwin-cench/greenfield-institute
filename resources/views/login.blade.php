<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Greenfield Institute</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-indigo-400">
            Greenfield Institute
        </h2>
        <p class="mt-2 text-center text-sm text-slate-400">
            Log in to your Student or Admin portal
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-800 py-8 px-4 shadow-xl shadow-indigo-900/20 sm:rounded-lg sm:px-10 border border-slate-700">

            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded mb-6 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="space-y-6" action="/login" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-slate-600 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-700 text-white">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-slate-600 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-700 text-white">
                    </div>
                </div>

                <div class="mt-6 flex flex-col space-y-4">
    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
        Log in
    </button>

    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-600"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-slate-800 text-slate-400">Or new to Greenfield?</span>
        </div>
    </div>

    <a href="/register" class="w-full flex justify-center py-2 px-4 border border-indigo-500 rounded-md shadow-sm text-sm font-medium text-indigo-400 hover:bg-slate-700 transition-colors">
        Register as a Student
    </a>
</div>
            </form>
        </div>
    </div>
</body>
</html>
