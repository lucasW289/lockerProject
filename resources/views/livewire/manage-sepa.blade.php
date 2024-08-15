<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Manage SEPA Records</h1>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

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
