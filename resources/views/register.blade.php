<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Greenfield Institute</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-indigo-400">
            Create an Account
        </h2>
        <p class="mt-2 text-center text-sm text-slate-400">
            Start your academic journey today
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-800 py-8 px-4 shadow-xl shadow-indigo-900/20 sm:rounded-lg sm:px-10 border border-slate-700">

            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded mb-6 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>&#8226; {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="/register" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300">Full Name</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" required class="appearance-none block w-full px-3 py-2 border border-slate-600 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-700 text-white">
                    </div>
                </div>

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

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300">Confirm Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none block w-full px-3 py-2 border border-slate-600 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-700 text-white">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-slate-900 transition-colors">
                        Register
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-slate-400">
                    Already have an account?
                    <a href="/login" class="font-medium text-indigo-400 hover:text-indigo-300">Log in here</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
