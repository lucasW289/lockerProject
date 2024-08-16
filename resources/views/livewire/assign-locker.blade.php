<div class="p-6 bg-gray-100">
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Children -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.lazy="searchTerm" 
            placeholder="Search Children..." 
            class="border border-gray-300 rounded-md px-4 py-2"
        >
        <button 
            wire:click="performSearch" 
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out"
        >
            Search Children
        </button>
    </div>

    <!-- Children Table -->
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Child Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SEPA Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Locker</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($children as $child)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $child->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $child->class->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $child->sepaStatus }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $child->locker ? $child->locker->locker_name : 'None' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button 
                                wire:click="showLockerOptions({{ $child->id }})" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out"
                                title="Assign a locker to {{ $child->name }}"
                            >
                                Assign Locker
                            </button>
                            <button 
                                wire:click="unassignLocker({{ $child->id }})" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out"
                                title="Unassign the locker from {{ $child->name }}"
                            >
                                Unassign Locker
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $children->links() }}
        </div>
    </div>

    <!-- Locker Selection -->
    @if($showLockerSelection)
        <div class="mt-6 p-4 bg-white border border-gray-300 rounded-lg shadow-lg">
            <h3 class="text-lg font-medium text-gray-700">Locker Assignment for {{ $children->find($selectedChildId)->name ?? '' }}</h3>
            <p class="text-sm text-gray-600 mt-1">
                Please select a locker from the list below and click "Confirm Assignment" to assign it to the selected child.
            </p>
            <input 
                type="text" 
                wire:model.lazy="lockerSearchTerm" 
                placeholder="Search Lockers..." 
                class="border border-gray-300 rounded-md px-4 py-2"
            >
            <button 
                wire:click="performLockerSearch" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out"
            >
                Search Lockers
            </button>
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($lockers as $locker)
                    <div 
                        wire:click="assignLocker({{ $locker->id }})" 
                        class="p-4 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-200"
                    >
                        <h4 class="text-md font-medium text-gray-800">{{ $locker->locker_name }}</h4>
                        <p class="text-sm text-gray-600">Status: {{ $locker->status }}</p>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center space-x-4 mt-4">
                <button 
                    wire:click="$set('showLockerSelection', false)" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out"
                >
                    Cancel
                </button>
            </div>
        </div>
    @endif
</div>

<script src="https://cdn.tailwindcss.com"></script>
