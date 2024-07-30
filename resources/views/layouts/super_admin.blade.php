<!-- resources/views/layouts/super_admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-green-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white text-xl font-bold">Super Admin</span>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('superadmin.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-green-700">Dashboard</a>
                    <a href="{{ route('superadmin.createAdmin') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-green-700">Create Admin</a>
                    <form action="{{ route('logout') }}" method="POST" class="ml-3">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-green-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @vite('resources/js/app.js')
</body>
</html>