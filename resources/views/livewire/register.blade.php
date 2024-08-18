<div class="max-w-md mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Register</h1>
    
    <form wire:submit.prevent="register">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Name:</label>
            <input type="text" id="name" wire:model="name" placeholder="Enter your name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200">
            @error('name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email:</label>
            <input type="email" id="email" wire:model="email" placeholder="Enter your email"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200">
            @error('email') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password:</label>
            <input type="password" id="password" wire:model="password" placeholder="Enter your password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200">
            @error('password') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-2">Confirm Password:</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" placeholder="Confirm your password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200">
            @error('password_confirmation') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <input type="hidden" wire:model="role_id" value="3">

        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">Register</button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-gray-600">Already registered? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Login</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com"></script>

<script>
    window.addEventListener('registration-success', () => {
        Swal.fire({
            title: 'Registration Successful!',
            text: 'You will be redirected to the dashboard.',
            icon: 'success',
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('user.dashboard') }}';
            }
        });
    });
</script>
