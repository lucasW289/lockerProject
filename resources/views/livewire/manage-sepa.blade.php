<div class="status-check-container bg-white p-6 sm:p-8 md:p-12 lg:p-16 xl:p-20 rounded-lg shadow-lg max-w-7xl mx-auto my-16 border border-gray-200 min-h-[800px] flex flex-col justify-between">
    <!-- Admin Dashboard Header -->
    <header class="dashboard-header mb-8">
        <div class="flex justify-between items-center bg-gray-600 text-white p-6 rounded-lg shadow-lg">
            <div>
                <h1 class="text-4xl font-bold">Admin Dashboard</h1>
                
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
    <nav class="dashboard-nav mb-8">
        <div class="overflow-x-auto">
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Dashboard</a> |
            <a href="{{route('manage.lockers')}}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Manage Lockers</a> |
            <a href="{{route('assign.locker')}}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Assign Locker</a> |
            <a href="{{route('manage.sepa')}}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">User Sepa</a> |
            <a href="{{route('manage.class')}}" class="text-blue-600 hover:text-blue-800 font-semibold">Manage Classes</a>
        </div>
    </nav>
    <h1 class="text-xl md:text-2xl font-bold mb-4">Manage SEPA Records</h1>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-3 border-b">Full Name</th>
                    <th class="p-3 border-b">Email</th>
                    <th class="p-3 border-b">File Path</th>
                    <th class="p-3 border-b">Verification Status</th>
                    <th class="p-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sepas as $sepa)
                    <tr class="odd:bg-gray-50 even:bg-gray-100">
                        <td class="p-3 border-b">{{ $sepa->full_name }}</td>
                        <td class="p-3 border-b">{{ $sepa->email }}</td>
                        <td class="p-3 border-b">
                            @if ($sepa->file_path)
                                <a href="{{ asset('storage/' . $sepa->file_path) }}" target="_blank" class="text-blue-500 hover:underline">View File</a>
                            @else
                                No file uploaded
                            @endif
                        </td>
                        <td class="p-3 border-b">
                            <span class="
                                @if ($sepa->verified == 'Pending') 
                                    text-yellow-500 
                                @elseif ($sepa->verified == 'Verified') 
                                    text-green-500 
                                @elseif ($sepa->verified == 'Rejected') 
                                    text-red-500 
                                @endif
                                font-semibold
                            ">
                                {{ $sepa->verified }}
                            </span>
                        </td>
                        <td class="p-3 border-b">
                            <button wire:click="selectSepa({{ $sepa->id }})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Manage</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($selectedSepa)
        <div class="mt-6 bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Manage SEPA: {{ $selectedSepa->full_name }}</h3>
            
            <div class="mb-6">
                <form wire:submit.prevent="uploadFile" class="space-y-4">
                    <div class="flex flex-col">
                        <label for="file" class="text-gray-700 font-medium">Choose SEPA PDF</label>
                        <input type="file" id="file" wire:model="file" class="mt-2 p-2 border border-gray-300 rounded"/>
                        @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Upload File</button>
                </form>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-2">Update SEPA Status</h4>
                <select wire:model="verificationStatus" wire:change="updateStatus" class="p-2 border border-gray-300 rounded mb-2 w-full">
                    <option value="Pending" class="text-yellow-500">Pending</option>
                    <option value="Verified" class="text-green-500">Verified</option>
                    <option value="Rejected" class="text-red-500">Rejected</option>
                </select>
                <button wire:click="updateStatus" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Status</button>
            </div>
        </div>
    @endif
</div>
<script src="https://cdn.tailwindcss.com"></script>
