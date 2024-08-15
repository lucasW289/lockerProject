<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Assign Lockers to Children</h1>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-3 border-b">Child's Name</th>
                <th class="p-3 border-b">Class</th>
                <th class="p-3 border-b">SEPA Verification Status</th>
                <th class="p-3 border-b">Assign Locker</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($children as $child)
                <tr class="odd:bg-gray-50 even:bg-gray-100">
                    <td class="p-3 border-b">{{ $child->name }}</td>
                    <td class="p-3 border-b">{{ $child->class->name }}</td>
                    <td class="p-3 border-b">
                        @if ($child->user->sepa->is_verified === 'Verified')
                            <span class="text-green-500 font-semibold">Verified</span>
                        @elseif ($child->user->sepa->is_verified === 'Pending')
                            <span class="text-yellow-500 font-semibold">Pending</span>
                        @elseif ($child->user->sepa->is_verified === 'Rejected')
                            <span class="text-red-500 font-semibold">Rejected</span>
                        @else
                            <span class="text-gray-500 font-semibold">Not Submitted</span>
                        @endif
                    </td>
                    <td class="p-3 border-b">
                        <select wire:model="selectedLocker" class="p-2 border border-gray-300 rounded">
                            <option value="">-- Select Locker --</option>
                            @foreach (Locker::where('assigned', false)->get() as $locker)
                                <option value="{{ $locker->id }}">Locker {{ $locker->id }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignLocker" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2">Assign</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.tailwindcss.com"></script>
