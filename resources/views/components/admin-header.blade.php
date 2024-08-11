 <!-- Admin Dashboard Header -->
 <header class="dashboard-header mb-8">
    <div class="flex justify-between items-center bg-gray-600 text-white p-6 rounded-lg shadow-lg">
        <div>
            <h1 class="text-4xl font-bold">Admin Dashboard</h1>
            <p class="text-2xl mt-2">Welcome back, {{ $user->name }}!</p>
        </div>
        <div class="relative group">
            <button wire:click="logout()"
                class="group flex items-center justify-start w-11 h-11 bg-red-600 rounded-full cursor-pointer relative overflow-hidden transition-all duration-200 shadow-lg hover:w-32 hover:rounded-lg active:translate-x-1 active:translate-y-1">
                <div
                    class="flex items-center justify-center w-full transition-all duration-300 group-hover:justify-start group-hover:px-3">
                    <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                        </path>
                    </svg>
                </div>
                <div
                    class="absolute right-5 transform translate-x-full opacity-0 text-white text-lg font-semibold transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                    Logout
                </div>
            </button>

        </div>
    </div>
</header>

<!-- Admin Dashboard Navigation -->
<nav class="dashboard-nav flex space-x-4 mb-8">
    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>
    <a href="{{route('manage.lockers')}}" class="text-blue-600 hover:text-blue-800 font-semibold">Manage Lockers</a>
    <a href="" class="text-blue-600 hover:text-blue-800 font-semibold">Assign Locker</a>
    <a href="" class="text-blue-600 hover:text-blue-800 font-semibold">User Sepa</a>
    <a href="" class="text-blue-600 hover:text-blue-800 font-semibold">Settings</a>
</nav>