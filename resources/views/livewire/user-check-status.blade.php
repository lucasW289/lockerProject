<div class="status-check-container bg-white p-6 sm:p-8 md:p-12 lg:p-16 xl:p-20 rounded-lg shadow-lg max-w-7xl mx-auto my-16 border border-gray-200 min-h-[800px] flex flex-col justify-between">
    <!-- User Dashboard Header -->
    <header class="dashboard-header mb-6 md:mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center bg-blue-600 text-white p-4 sm:p-6 rounded-lg shadow-lg">
            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold">User Dashboard</h1>
                <p class="text-lg sm:text-xl md:text-2xl mt-2">Welcome back, {{ $user->name }}!</p>
            </div>
            <div class="relative group mt-4 md:mt-0">
                <button wire:click="logout()"
                    class="group flex items-center justify-start w-11 h-11 bg-red-600 rounded-full cursor-pointer relative overflow-hidden transition-all duration-200 shadow-lg hover:w-32 hover:rounded-lg active:translate-x-1 active:translate-y-1">
                    <div class="flex items-center justify-center w-full transition-all duration-300 group-hover:justify-start group-hover:px-3">
                        <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white">
                            <path
                                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                            </path>
                        </svg>
                    </div>
                    <div class="absolute right-5 transform translate-x-full opacity-0 text-white text-lg font-semibold transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                        Logout
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- User Dashboard Navigation -->
    <nav class="dashboard-nav mb-6 md:mb-8">
        <ul class="flex flex-wrap gap-4 text-center">
            <li><a href="{{ url('/user-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a></li> |
            <li><a href="{{ route('rent-locker') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Rent Locker</a></li> |
            <li><a href="{{ route('sepa.steps') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Sepa Payment</a></li> |
            <li><a href="{{ route('check.status') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Check Status</a></li> 
        </ul>
    </nav>

    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 text-gray-800">User Status Check</h2>

    <div class="status-section mb-6">
        <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-700">SEPA Status</h3>
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <p class="text-gray-800 {{ $sepaStatusClass }}">{{ $sepaStatus }}</p>
        </div>
    </div>

    <div class="status-section">
        <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-700">Children Locker Assignment</h3>
        @if (count($childrenList) > 0)
            <div class="space-y-4">
                @foreach ($childrenList as $child)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg sm:text-xl font-medium mb-2 text-gray-800">{{ $child['name'] }}</h4>
                        @if ($child['locker_id'])
                            @php
                                $locker = $child['locker_info'];
                            @endphp
                            @if ($locker)
                                <p class="text-green-600">
                                    Assigned to: <span class="font-semibold">{{ $locker->locker_name }}, Building {{ $locker->building }}, Floor {{ $locker->floor }}</span>
                                </p>
                            @else
                                <p class="text-red-600">Locker information not found</p>
                            @endif
                        @else
                            <p class="text-red-600">Not Assigned</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No children found for the user.</p>
        @endif
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
