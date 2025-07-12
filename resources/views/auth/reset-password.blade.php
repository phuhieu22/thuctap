<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
        <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
            <div class="flex justify-center mb-6">
                <a href="{{ route('login.form') }}">
                    <button
                        class="px-6 py-2 rounded-l-lg border border-r-0 border-gray-200 text-gray-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Login
                    </button>
                </a>
                <button class="px-6 py-2 rounded-r-lg bg-blue-700 text-white font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Register
                </button>
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

            {{-- Form --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm mb-1">First name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Confirm password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="terms" class="mr-2" required />
                    <label for="terms" class="text-sm text-gray-600">
                        I agree to the
                        <a href="#" class="text-blue-600 underline">Terms of Service</a>
                        and
                        <a href="#" class="text-blue-600 underline">Privacy Policy</a>
                    </label>
                </div>
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-700 to-blue-500 text-white font-semibold py-2 rounded-lg shadow hover:from-blue-800 hover:to-blue-600 transition">
                    Create Account
                </button>
            </form>
        </div>

        {{-- Newsletter phần dưới --}}
        <div class="w-full mt-16 bg-gray-100 py-12">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-2xl font-semibold mb-2">Join Our Newsletter</h2>
                <p class="text-gray-500 mb-6">Subscribe to get special offers, free giveaways, and once-in-a-lifetime
                    deals.</p>
                <form class="flex items-center justify-center gap-2">
                    <input type="email" placeholder="Your email address"
                        class="flex-1 px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 bg-white" />
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-700 to-blue-500 text-white font-semibold px-6 py-2 rounded-full shadow hover:from-blue-800 hover:to-blue-600 transition">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
