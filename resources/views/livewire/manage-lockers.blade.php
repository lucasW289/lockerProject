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
    <!-- Notification Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif



    <!-- Add Locker Form -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold mb-4">Add New Locker</h2>

        <form wire:submit.prevent="addLocker">
            <div class="mb-4">
                <label for="locker_name" class="block text-lg font-medium mb-2">Locker Name:</label>
                <input type="text" id="locker_name" wire:model="locker_name"
                    class="border border-gray-300 rounded px-3 py-2 w-full">
                @error('locker_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="building" class="block text-lg font-medium mb-2">Building:</label>
                <input type="text" id="building" wire:model="building"
                    class="border border-gray-300 rounded px-3 py-2 w-full">
                @error('building')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="floor" class="block text-lg font-medium mb-2">Floor:</label>
                <input type="text" id="floor" wire:model="floor"
                    class="border border-gray-300 rounded px-3 py-2 w-full">
                @error('floor')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="status" class="block text-lg font-medium mb-2">Status:</label>
                <select id="status" wire:model="status" class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">Select Status</option>
                    <option value="Available">Available</option>
                    <option value="In Use">In Use</option>
                    <option value="Out of Service">Out of Service</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Add Locker
            </button>
        </form>
    </div>

    <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold mb-4">Filter Lockers</h2>

        <form wire:submit.prevent="applyFilters" class="flex flex-wrap gap-4">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Name"
                class="border border-gray-300 rounded px-3 py-2 w-full sm:w-1/4">
            <input type="text" wire:model.debounce.300ms="buildingFilter" placeholder="Filter by Building"
                class="border border-gray-300 rounded px-3 py-2 w-full sm:w-1/4">
            <input type="text" wire:model.debounce.300ms="floorFilter" placeholder="Filter by Floor"
                class="border border-gray-300 rounded px-3 py-2 w-full sm:w-1/4">
            <select wire:model="statusFilter" class="border border-gray-300 rounded px-3 py-2 w-full sm:w-1/4">
                <option value="">Filter by Status</option>
                <option value="Available">Available</option>
                <option value="In Use">In Use</option>
                <option value="Out of Service">Out of Service</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Apply Filters
            </button>
            <button type="button" wire:click="resetFilters" class="bg-gray-500 text-white px-4 py-2 rounded">
                Reset Filters
            </button>
        </form>
    </div>


    <!-- Locker Table -->
    <!-- Locker Table -->
<!-- Locker Table -->
<div class="mb-6">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead>
            <!-- Existing table headers -->
            <tr>
                <th class="py-2 px-4 border-b">
                    <button wire:click.prevent="sort('locker_name')">
                        Locker Name
                        @if ($sortField === 'locker_name')
                            @if ($sortDirection === 'asc')
                                <span>&#9650;</span>
                            @else
                                <span>&#9660;</span>
                            @endif
                        @endif
                    </button>
                </th>
                <th class="py-2 px-4 border-b">
                    <button wire:click.prevent="sort('building')">
                        Building
                        @if ($sortField === 'building')
                            @if ($sortDirection === 'asc')
                                <span>&#9650;</span>
                            @else
                                <span>&#9660;</span>
                            @endif
                        @endif
                    </button>
                </th>
                <th class="py-2 px-4 border-b">
                    <button wire:click.prevent="sort('floor')">
                        Floor
                        @if ($sortField === 'floor')
                            @if ($sortDirection === 'asc')
                                <span>&#9650;</span>
                            @else
                                <span>&#9660;</span>
                            @endif
                        @endif
                    </button>
                </th>
                <th class="py-2 px-4 border-b">
                    <button wire:click.prevent="sort('status')">
                        Status
                        @if ($sortField === 'status')
                            @if ($sortDirection === 'asc')
                                <span>&#9650;</span>
                            @else
                                <span>&#9660;</span>
                            @endif
                        @endif
                    </button>
                </th>
                <th class="py-2 px-4 border-b text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lockers as $locker)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $locker->locker_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $locker->building }}</td>
                    <td class="py-2 px-4 border-b">{{ $locker->floor }}</td>
                    <td class="py-2 px-4 border-b">
                        <!-- Apply color based on status -->
                        <span class="inline-block px-3 py-1 rounded-full text-white font-semibold
                            {{ $locker->status === 'Available' ? 'bg-green-500' :
                               ($locker->status === 'In Use' ? 'bg-red-500' : 'bg-gray-500') }}">
                            {{ $locker->status }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b text-right">
                        <button wire:click="selectToUpdate({{ $locker->id }})"
                                class="bg-blue-500 text-white px-4 py-2 rounded">
                            Edit
                        </button>
                        <button wire:click="selectToDelete({{ $locker->id }})"
                                class="bg-red-500 text-white px-4 py-2 rounded ml-2">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $lockers->links('pagination::tailwind') }}
    </div>
</div>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com"></script>


<!-- Handle browser events -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-delete-confirmation', event => {
            const lockerId = event.detail[0].id; // Capture the ID
            console.log(event.detail);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make sure the ID is being used correctly
                    console.log('Deleting locker with ID:', lockerId);

                    @this.call('deleteLocker', lockerId).then(() => {
                        // Log success message
                        console.log('Delete method called successfully');
                    }).catch(error => {
                        // Log any errors
                        console.error('Error calling deleteLocker method:', error);
                    });
                }
            });
        });
        window.addEventListener('show-edit-confirmation', event => {
            const { id, locker_name, building, floor, status } = event.detail[0];

            Swal.fire({
                title: 'Edit Locker',
                html: `
                    <div class="space-y-4">
                        <input id="locker_name" class="swal2-input p-2 border border-gray-300 rounded" value="${locker_name}" placeholder="Locker Name">
                        <input id="building" class="swal2-input p-2 border border-gray-300 rounded" value="${building}" placeholder="Building">
                        <input id="floor" class="swal2-input p-2 border border-gray-300 rounded" value="${floor}" placeholder="Floor">
                        <select id="status" class="swal2-input p-2 border border-gray-300 rounded">
                            <option value="Available" ${status === 'Available' ? 'selected' : ''}>Available</option>
                            <option value="In Use" ${status === 'In Use' ? 'selected' : ''}>In Use</option>
                            <option value="Out of Service" ${status === 'Out of Service' ? 'selected' : ''}>Out of Service</option>
                        </select>
                    </div>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const locker_name = document.getElementById('locker_name').value;
                    const building = document.getElementById('building').value;
                    const floor = document.getElementById('floor').value;
                    const status = document.getElementById('status').value;

                    // Basic validation
                    if (!locker_name || !building || !floor || !status) {
                        Swal.showValidationMessage('Please fill out all fields');
                        return false;
                    }

                    return { locker_name, building, floor, status };
                },
                confirmButtonText: 'Save Changes',
                cancelButtonText: 'Cancel',
                showCancelButton: true,
                customClass: {
                    container: 'p-4',
                    popup: 'bg-white rounded-lg shadow-lg p-6',
                    header: 'text-lg font-semibold',
                    title: 'text-lg font-semibold',
                    closeButton: 'text-gray-600',
                    icon: 'text-yellow-500',
                    htmlContainer: 'space-y-4',
                    input: 'p-2 border border-gray-300 rounded',
                    actions: 'flex justify-end mt-4',
                    confirmButton: 'bg-blue-500 text-white px-4 py-2 rounded ml-2',
                    cancelButton: 'bg-gray-300 text-gray-800 px-4 py-2 rounded ml-2',
                },
                backdrop: true
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Updating locker with ID:', id);

                    @this.call('updateLocker', id, result.value).then(() => {
                        console.log('Update method called successfully');
                    }).catch(error => {
                        console.error('Error calling updateLocker method:', error);
                    });
                }
            });
        });
    });
</script>
