<div class="container mx-auto px-4 py-8">
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

    <!-- Main Content -->
    <main class="grid grid-cols-1 lg:grid-cols-1 gap-9">
        <!-- Overview Section -->
        <div>
            <h2 class="text-2xl font-semibold mb-4">Overview</h2>
            <p class="text-gray-700 mb-4">Quick summary of recent activities and stats.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Total Users -->
                <div
                    class="group bg-[#0275d8] p-5 rounded-lg shadow-lg transition-transform  cursor-pointer hover:translate-y-1 hover:shadow-lg">
                    <p class="text-white text-2xl">{{ $totalUserCount }}</p>
                    <p class="text-white text-sm">Total Users</p>
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                        height="36" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-20 transition-opacity  group-hover:opacity-100 group-hover:scale-110">
                        <g>
                            <path fill="#ffffff"
                                d="M135.169 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM256 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.643 30.485 30.474 30.485zM376.83 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.525-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM118.391 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.042-13.502-13.497-13.502h-33.556zM239.221 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM360.052 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM66.25 356.095a26.11 26.11 0 0 0 7.425-1.08l37.866-11.209c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l29.888 8.848c12.377 3.664 25.284 5.496 38.19 5.496s25.813-1.832 38.19-5.496l29.888-8.848c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l37.866 11.209a26.146 26.146 0 0 0 7.425 1.08c12.118 0 22.787-8.481 22.787-19.746v-38.672c0-12.82-12.02-23.213-26.848-23.213H70.312c-14.828 0-26.848 10.393-26.848 23.213v38.672c0 11.265 10.67 19.746 22.786 19.746zM497 477.12h-40.946v-91.989a56.002 56.002 0 0 1-10.305.964 56.132 56.132 0 0 1-15.941-2.313l-37.866-11.209c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-29.888 8.848c-15.086 4.466-30.799 6.73-46.705 6.73s-31.62-2.264-46.706-6.73l-29.888-8.848c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-37.866 11.209a56.138 56.138 0 0 1-15.941 2.314c-3.487 0-6.935-.333-10.305-.964v91.989H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h482c8.284 0 15-6.716 15-15s-6.716-15.001-15-15.001z">
                            </path>
                        </g>
                    </svg>
                </div>

                <!-- Pending Sepa -->
                <div
                    class="group bg-[#f0ad4e] p-5 rounded-lg shadow-lg transition-transform  cursor-pointer hover:translate-y-1 hover:shadow-lg">
                    <p class="text-white text-2xl">{{ $sepaPendingCount }}</p>
                    <p class="text-white text-sm">Pending Sepa</p>
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                        height="36" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-20 transition-opacity  group-hover:opacity-100 group-hover:scale-110">
                        <g>
                            <path fill="#ffffff"
                                d="M135.169 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM256 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.643 30.485 30.474 30.485zM376.83 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.525-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM118.391 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.042-13.502-13.497-13.502h-33.556zM239.221 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM360.052 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM66.25 356.095a26.11 26.11 0 0 0 7.425-1.08l37.866-11.209c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l29.888 8.848c12.377 3.664 25.284 5.496 38.19 5.496s25.813-1.832 38.19-5.496l29.888-8.848c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l37.866 11.209a26.146 26.146 0 0 0 7.425 1.08c12.118 0 22.787-8.481 22.787-19.746v-38.672c0-12.82-12.02-23.213-26.848-23.213H70.312c-14.828 0-26.848 10.393-26.848 23.213v38.672c0 11.265 10.67 19.746 22.786 19.746zM497 477.12h-40.946v-91.989a56.002 56.002 0 0 1-10.305.964 56.132 56.132 0 0 1-15.941-2.313l-37.866-11.209c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-29.888 8.848c-15.086 4.466-30.799 6.73-46.705 6.73s-31.62-2.264-46.706-6.73l-29.888-8.848c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-37.866 11.209a56.138 56.138 0 0 1-15.941 2.314c-3.487 0-6.935-.333-10.305-.964v91.989H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h482c8.284 0 15-6.716 15-15s-6.716-15.001-15-15.001z">
                            </path>
                        </g>
                    </svg>
                </div>

                <!-- Total Locker -->
                <div
                    class="group bg-[#5bc0de] p-5 rounded-lg shadow-lg transition-transform  cursor-pointer hover:translate-y-1 hover:shadow-lg">
                    <p class="text-white text-2xl">{{ $totalLockersCount }}</p>
                    <p class="text-white text-sm">Total Lockers</p>
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                        height="36" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-20 transition-opacity  group-hover:opacity-100 group-hover:scale-110">
                        <g>
                            <path fill="#ffffff"
                                d="M135.169 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM256 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.643 30.485 30.474 30.485zM376.83 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.525-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM118.391 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.042-13.502-13.497-13.502h-33.556zM239.221 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM360.052 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM66.25 356.095a26.11 26.11 0 0 0 7.425-1.08l37.866-11.209c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l29.888 8.848c12.377 3.664 25.284 5.496 38.19 5.496s25.813-1.832 38.19-5.496l29.888-8.848c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l37.866 11.209a26.146 26.146 0 0 0 7.425 1.08c12.118 0 22.787-8.481 22.787-19.746v-38.672c0-12.82-12.02-23.213-26.848-23.213H70.312c-14.828 0-26.848 10.393-26.848 23.213v38.672c0 11.265 10.67 19.746 22.786 19.746zM497 477.12h-40.946v-91.989a56.002 56.002 0 0 1-10.305.964 56.132 56.132 0 0 1-15.941-2.313l-37.866-11.209c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-29.888 8.848c-15.086 4.466-30.799 6.73-46.705 6.73s-31.62-2.264-46.706-6.73l-29.888-8.848c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-37.866 11.209a56.138 56.138 0 0 1-15.941 2.314c-3.487 0-6.935-.333-10.305-.964v91.989H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h482c8.284 0 15-6.716 15-15s-6.716-15.001-15-15.001z">
                            </path>
                        </g>
                    </svg>
                </div>

                <!-- Available Lockers -->
                <div
                    class="group bg-[#5cb85c] p-5 rounded-lg shadow-lg transition-transform  cursor-pointer hover:translate-y-1 hover:shadow-lg">
                    <p class="text-white text-2xl">{{ $availableLockersCount }}</p>
                    <p class="text-white text-sm">Available Lockers</p>
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                        height="36" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-20 transition-opacity  group-hover:opacity-100 group-hover:scale-110">
                        <g>
                            <path fill="#ffffff"
                                d="M135.169 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM256 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.643 30.485 30.474 30.485zM376.83 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.525-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM118.391 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.042-13.502-13.497-13.502h-33.556zM239.221 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM360.052 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM66.25 356.095a26.11 26.11 0 0 0 7.425-1.08l37.866-11.209c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l29.888 8.848c12.377 3.664 25.284 5.496 38.19 5.496s25.813-1.832 38.19-5.496l29.888-8.848c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l37.866 11.209a26.146 26.146 0 0 0 7.425 1.08c12.118 0 22.787-8.481 22.787-19.746v-38.672c0-12.82-12.02-23.213-26.848-23.213H70.312c-14.828 0-26.848 10.393-26.848 23.213v38.672c0 11.265 10.67 19.746 22.786 19.746zM497 477.12h-40.946v-91.989a56.002 56.002 0 0 1-10.305.964 56.132 56.132 0 0 1-15.941-2.313l-37.866-11.209c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-29.888 8.848c-15.086 4.466-30.799 6.73-46.705 6.73s-31.62-2.264-46.706-6.73l-29.888-8.848c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-37.866 11.209a56.138 56.138 0 0 1-15.941 2.314c-3.487 0-6.935-.333-10.305-.964v91.989H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h482c8.284 0 15-6.716 15-15s-6.716-15.001-15-15.001z">
                            </path>
                        </g>
                    </svg>
                </div>

                <!-- Lockers in Use -->
                <div
                    class="group bg-[#d9534f] p-5 rounded-lg shadow-lg transition-transform  cursor-pointer hover:translate-y-1 hover:shadow-lg">
                    <p class="text-white text-2xl">{{ $lockersInUseCount }}</p>
                    <p class="text-white text-sm"> Lockers In Use</p>
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                        height="36" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-20 transition-opacity  group-hover:opacity-100 group-hover:scale-110">
                        <g>
                            <path fill="#ffffff"
                                d="M135.169 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM256 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.643 30.485 30.474 30.485zM376.83 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.525-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM118.391 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.042-13.502-13.497-13.502h-33.556zM239.221 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM360.052 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM66.25 356.095a26.11 26.11 0 0 0 7.425-1.08l37.866-11.209c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l29.888 8.848c12.377 3.664 25.284 5.496 38.19 5.496s25.813-1.832 38.19-5.496l29.888-8.848c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l37.866 11.209a26.146 26.146 0 0 0 7.425 1.08c12.118 0 22.787-8.481 22.787-19.746v-38.672c0-12.82-12.02-23.213-26.848-23.213H70.312c-14.828 0-26.848 10.393-26.848 23.213v38.672c0 11.265 10.67 19.746 22.786 19.746zM497 477.12h-40.946v-91.989a56.002 56.002 0 0 1-10.305.964 56.132 56.132 0 0 1-15.941-2.313l-37.866-11.209c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-29.888 8.848c-15.086 4.466-30.799 6.73-46.705 6.73s-31.62-2.264-46.706-6.73l-29.888-8.848c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-37.866 11.209a56.138 56.138 0 0 1-15.941 2.314c-3.487 0-6.935-.333-10.305-.964v91.989H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h482c8.284 0 15-6.716 15-15s-6.716-15.001-15-15.001z">
                            </path>
                        </g>
                    </svg>
                </div>

                <!-- Lockers Out of Service -->
                <div
                    class="group bg-[gray] p-5 rounded-lg shadow-lg transition-transform  cursor-pointer hover:translate-y-1 hover:shadow-lg">
                    <p class="text-white text-2xl">{{ $lockersOutOfServiceCount }}</p>
                    <p class="text-white text-sm"> Lockers Out of Service</p>
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                        height="36" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-20 transition-opacity  group-hover:opacity-100 group-hover:scale-110">
                        <g>
                            <path fill="#ffffff"
                                d="M135.169 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM256 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.524-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.643 30.485 30.474 30.485zM376.83 91.902c16.83 0 30.474-13.649 30.474-30.485 0-11.22-13.533-36.418-22.563-51.981-3.525-6.075-12.297-6.075-15.822 0-9.029 15.563-22.563 40.761-22.563 51.981 0 16.836 13.644 30.485 30.474 30.485zM118.391 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.042-13.502-13.497-13.502h-33.556zM239.221 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM360.052 116.951c-7.454 0-13.497 6.045-13.497 13.502v108.924h60.55V130.454c0-7.457-6.043-13.502-13.497-13.502h-33.556zM66.25 356.095a26.11 26.11 0 0 0 7.425-1.08l37.866-11.209c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l29.888 8.848c12.377 3.664 25.284 5.496 38.19 5.496s25.813-1.832 38.19-5.496l29.888-8.848c12.377-3.664 25.284-5.496 38.19-5.496s25.813 1.832 38.19 5.496l37.866 11.209a26.146 26.146 0 0 0 7.425 1.08c12.118 0 22.787-8.481 22.787-19.746v-38.672c0-12.82-12.02-23.213-26.848-23.213H70.312c-14.828 0-26.848 10.393-26.848 23.213v38.672c0 11.265 10.67 19.746 22.786 19.746zM497 477.12h-40.946v-91.989a56.002 56.002 0 0 1-10.305.964 56.132 56.132 0 0 1-15.941-2.313l-37.866-11.209c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-29.888 8.848c-15.086 4.466-30.799 6.73-46.705 6.73s-31.62-2.264-46.706-6.73l-29.888-8.848c-9.553-2.828-19.537-4.262-29.674-4.262s-20.121 1.434-29.674 4.262l-37.866 11.209a56.138 56.138 0 0 1-15.941 2.314c-3.487 0-6.935-.333-10.305-.964v91.989H15c-8.284 0-15 6.716-15 15s6.716 15 15 15h482c8.284 0 15-6.716 15-15s-6.716-15.001-15-15.001z">
                            </path>
                        </g>
                    </svg>
                </div>


            </div>
        </div>
    </main>
</div>

<script src="https://cdn.tailwindcss.com"></script>
