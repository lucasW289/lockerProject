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

    <!-- Admin Dashboard Navigation -->
    <nav class="dashboard-nav mb-8">
        <div class="overflow-x-auto">
            <a href="{{ route('admin.dashboard') }}"
                class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Dashboard</a> |
            <a href="{{ route('manage.lockers') }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Manage
                Lockers</a> |
            <a href="{{ route('assign.locker') }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Assign
                Locker</a> |
            <a href="{{ route('manage.sepa') }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">User
                Sepa</a> |
            <a href="{{ route('manage.class') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Manage
                Classes</a>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg shadow-md">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-lg shadow-md">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add/Edit Class Form -->
    <div class="mb-6 p-6 bg-white border border-gray-300 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            {{ $editing ? 'Edit Class' : 'Add New Class' }}
        </h3>
        <form wire:submit.prevent="storeClass">
            <div class="mb-4">
                <label for="className" class="block text-sm font-medium text-gray-700">Class Name</label>
                <input type="text" id="className" wire:model.lazy="className"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                @error('className')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="building" class="block text-sm font-medium text-gray-700">Building</label>
                <input type="text" id="building" wire:model.lazy="building"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                @error('building')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col sm:flex-row sm:space-x-2">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    {{ $editing ? 'Update Class' : 'Add Class' }}
                </button>
                <button type="button" wire:click="resetFields"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 mt-2 sm:mt-0">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- Classes Table -->
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class
                        Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Building
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($classes as $class)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $class->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $class->building }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                            <button wire:click="editClass({{ $class->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                                Edit
                            </button>
                            <button onclick="confirmDeleteClass({{ $class->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    function confirmDeleteClass(classId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Deleting this class will also delete all associated students. This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('deleteClass', classId);
            }
        });
    }
</script>

