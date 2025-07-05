<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-md">
            <div class="flex mb-8">
                <button class="flex-1 py-2 rounded-lg bg-blue-700 text-white font-bold flex items-center justify-center gap-2 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Login
                </button>
                <a href="{{ route('register.form') }}">
                    <button type="button" class="flex-1 py-2 rounded-lg bg-gray-100 text-gray-600 font-bold flex items-center justify-center gap-2 ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Register
                    </button>
                </a>
            </div>

            {{-- Hiển thị lỗi --}}
            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Hiển thị thông báo --}}
            @if (session('success'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="email">Email address</label>
                    <input
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="password">Password</label>
                    <input
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="{{ route('forgot.form') }}" class="text-blue-600 text-sm font-medium hover:underline">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-700 to-blue-400 text-white font-bold rounded-lg shadow hover:from-blue-800 transition">Login</button>
            </form>
        </div>
    </div>

    <div class="bg-gray-100 py-16">
        <div class="max-w-xl mx-auto text-center">
            <h2 class="text-2xl font-bold mb-2">Join Our Newsletter</h2>
            <p class="mb-6 text-gray-600">Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
            <form class="flex items-center bg-white rounded-full shadow px-4 py-2 max-w-lg mx-auto">
                <input type="email" placeholder="Your email address" class="flex-1 px-4 py-2 rounded-full focus:outline-none">
                <button type="submit" class="ml-2 px-6 py-2 bg-blue-700 text-white font-bold rounded-full shadow hover:bg-blue-800 transition">Subscribe</button>
            </form>
        </div>
    </div>

</body>
</html>
