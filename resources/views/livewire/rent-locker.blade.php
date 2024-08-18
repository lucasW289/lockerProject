<!-- resources/views/livewire/rent-locker.blade.php -->
<div class="status-check-container bg-white p-6 sm:p-8 md:p-12 lg:p-16 xl:p-20 rounded-lg shadow-lg max-w-7xl mx-auto my-16 border border-gray-200 min-h-[800px] flex flex-col justify-between">
    <!-- User Dashboard Header -->
    <header class="dashboard-header mb-8">
        <div class="flex justify-between items-center bg-blue-600 text-white p-6 rounded-lg shadow-lg">
            <div>
                <h1 class="text-4xl font-bold">User Dashboard</h1>
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

    <!-- User Dashboard Navigation -->
    <nav class="dashboard-nav flex space-x-4 mb-8">
        <a href="{{ url('/user-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>  | 
        <a href="{{ route('rent-locker') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Rent Locker</a>  | 
        <a href="{{ route('sepa.steps') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Sepa Payment</a>  | 
        <a href="{{route('check.status')}}" class="text-blue-600 hover:text-blue-800 font-semibold">Check Status</a>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
            <!-- Steps Navigation -->
            <div class="steps-nav flex justify-center space-x-4 mb-8">
                <button wire:click="goToStep(1)"
                    class="px-4 py-2 rounded-lg transition-colors duration-200 {{ $step === 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">1. Choose Package
                </button>
                <button wire:click="goToStep(2)"
                    class="px-4 py-2 rounded-lg transition-colors duration-200 {{ $step === 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                    {{ $selectedPackage ? '' : 'disabled' }}>2. Register Child
                </button>
            </div>
    
            <!-- Step Content -->
            <div class="step-content">
                @if ($step === 1)
                    <div>
                        <h2 class="text-2xl font-semibold mb-4">Choose Package</h2>
                        <div class="packages-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($packages as $package)
                                <div class="package-card p-4 rounded-lg border transition-transform transform hover:scale-105 cursor-pointer {{ $selectedPackage === $package->id ? 'border-blue-600' : 'border-gray-300' }}"
                                    wire:click="selectPackage({{ $package->id }})">
                                    <h3 class="text-xl font-bold mb-2">{{ $package->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $package->description }}</p>
                                    <p class="text-lg font-semibold">Price: {{ $package->price }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-right mt-6">
                            <button wire:click="submitPackage"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg transition-colors duration-200 hover:bg-blue-700"
                                {{ $selectedPackage ? '' : 'disabled' }}>Next</button>
                        </div>
                    </div>
                @elseif ($step === 2)
                    <div>
                        <h2 class="text-2xl font-semibold mb-4">Register Child</h2>
                        <form wire:submit.prevent="submitChildData">
                            <div class="form-group mb-4">
                                <label for="child_name" class="block text-lg font-medium text-gray-700">Child's Name</label>
                                <input type="text" id="child_name" wire:model="childData.name" placeholder="Child's Name"
                                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('childData.name')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="child_birth_date" class="block text-lg font-medium text-gray-700">Child's Birthdate</label>
                                <input type="date" id="child_birth_date" wire:model="childData.birth_date"
                                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('childData.birth_date')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="child_class" class="block text-lg font-medium text-gray-700">Class</label>
                                <select id="child_class" wire:model="childData.class_id"
                                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('childData.class_id')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg transition-colors duration-200 hover:bg-blue-700">Register</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.tailwindcss.com"></script>
