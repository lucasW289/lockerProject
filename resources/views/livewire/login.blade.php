<div class="max-w-md mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg md:max-w-lg lg:max-w-xl">
    <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
            <input type="email" id="email" wire:model="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200">
            @error('email') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
            <input type="password" id="password" wire:model="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200">
            @error('password') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">Login</button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">Register</a></p>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('loginSuccess', (data) => {
            localStorage.setItem('sanctum_token', data.token);
            window.location.href = data.redirect; // Redirect to the appropriate dashboard
        });

        Livewire.on('loginError', (errors) => {
            // Handle login errors
            console.log(errors);
        });
    });
</script>
