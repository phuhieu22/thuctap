<!-- resources/views/auth/reset_password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Reset Your Password</h2>

            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>- {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $email) }}" required class="w-full border rounded px-4 py-2">
                </div>

                <div class="mb-4">
                    <label>New Password</label>
                    <input type="password" name="password" required class="w-full border rounded px-4 py-2">
                </div>

                <div class="mb-4">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" required class="w-full border rounded px-4 py-2">
                </div>

                <button type="submit" class="w-full py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>
