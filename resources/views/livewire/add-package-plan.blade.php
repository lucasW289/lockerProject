<div
    class="status-check-container bg-white p-6 sm:p-8 md:p-12 lg:p-16 xl:p-20 rounded-lg shadow-lg max-w-7xl mx-auto my-16 border border-gray-200 min-h-[800px] flex flex-col justify-between">
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
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Package Name</label>
                <input type="text" id="name" wire:model="name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" wire:model="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                @error('description')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" wire:model="price" step="0.01"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('price')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    {{ $isEditing ? 'Update Package Plan' : 'Create Package Plan' }}
                </button>
            </div>
        </form>

        <h2 class="text-xl font-semibold mt-8 mb-4">Existing Package Plans</h2>

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Price</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($packages as $package)
                    <tr>
                        <td class="py-2 px-4">{{ $package->name }}</td>
                        <td class="py-2 px-4">{{ $package->description }}</td>
                        <td class="py-2 px-4">${{ number_format($package->price, 2) }}</td>
                        <td class="py-2 px-4">
                            <button wire:click="edit({{ $package->id }})"
                                class="bg-yellow-500 text-white px-2 py-1 rounded-lg mr-2">Edit</button>
                            <button onclick="confirmDelete({{ $package->id }})"
                                class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-2 px-4 text-center">No packages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>

<script>
    function confirmDelete(packageId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', packageId);
                Swal.fire(
                    'Deleted!',
                    'The package has been deleted.',
                    'success'
                )
            }
        })
    }
</script>
