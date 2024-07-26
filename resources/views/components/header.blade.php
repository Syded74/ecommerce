<div class="flex justify-between items-center bg-white p-4 shadow-md">
    <div class="text-lg font-semibold text-green-800">Dashboard</div>
    <div class="flex items-center space-x-4">
        <div class="relative">
            <input type="text" class="border rounded-full py-2 px-4" placeholder="Search">
            <svg class="h-6 w-6 absolute top-2 right-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 10-14 0 7 7 0 0014 0z"></path>
            </svg>
        </div>
        <div class="relative" x-data="{ dropdownOpen: false }">
            <button class="flex items-center focus:outline-none" @click="dropdownOpen = !dropdownOpen">
                <span>{{ Auth::user()->name }}</span>
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="User Avatar" class="h-8 w-8 rounded-full ml-2">
                @else
                    <img src="{{ asset('path/to/default-avatar.png') }}" alt="User Avatar" class="h-8 w-8 rounded-full ml-2">
                @endif
                <svg class="h-5 w-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 w-full text-left">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
