<div class="container mx-auto px-4 py-8">

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
            <div class="flex-1">
                <label for="name" class="block text-lg font-medium mb-2">Name:</label>
                <input type="text" id="name" wire:model.debounce.300ms="search" 
                    class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Search by name...">
            </div>
            <div class="flex-1">
                <label for="building" class="block text-lg font-medium mb-2">Building:</label>
                <input type="text" id="building" wire:model="building"
                    class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Search by building...">
            </div>
            <div class="flex-1">
                <label for="floor" class="block text-lg font-medium mb-2">Floor:</label>
                <input type="text" id="floor" wire:model="floor"
                    class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Search by floor...">
            </div>
            <div class="flex-1">
                <label for="status" class="block text-lg font-medium mb-2">Status:</label>
                <select id="status" wire:model="status" class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">All Statuses</option>
                    <option value="Available">Available</option>
                    <option value="In Use">In Use</option>
                    <option value="Out of Service">Out of Service</option>
                </select>
            </div>
            <div class="flex-shrink-0 flex items-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Apply Filters
                </button>
            </div>
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
