<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Health Info System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
      body { background-color: #F5F7FA; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#F5F7FA]">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-[#2C62EA]">Sign in to your account</h2>
        @if(session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input id="email" type="email" name="email" autocomplete="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#2C62EA]" autofocus>
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#2C62EA]">
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-[#2C62EA]">
                    <span class="ml-2 text-gray-600 text-sm">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-[#29B6F6] hover:underline">Forgot password?</a>
            </div>
            <div>
                <button type="submit"
                        class="w-full py-2 px-4 bg-[#2C62EA] hover:bg-[#1a42ae] text-white font-semibold rounded transition-colors">
                    Sign in
                </button>
            </div>
        </form>
        <p class="mt-6 text-center text-gray-600 text-sm">
            Don’t have an account? <a href="{{ route('register') }}" class="text-[#29B6F6] hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>
